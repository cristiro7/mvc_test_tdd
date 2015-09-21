<?php
/**
 * Class EmployeesController
 * Controls the login processes
 */
class EmployeesController extends \Controller
{
    /**
     * Index, default action (shows the login form), when you do employees/index or index
     */
    function index()
    {
        $this->view->set('title', 'Register Form');

        // show the view
        return $this->view->output();
    }
    
    function register_confirm(){
        $this->view->set('title', 'Registration confirmation');
        // show the view
        return $this->view->output();
    }
    
    /**
     * The register action, when you do employees/register
     * If register is false , output errors
     */
    function register(){
        if(!empty($_POST['registerFormSubmit'])){ // User submit register form
            $employee = new EmployeesModel();
            $employee->setData($_POST);
            $valid = $employee->checkValid();
            if($valid['result']){
                $result = $employee->register();
                if($result['result']){
                    header('Location: ' . BASE_PATH . 'employees/register_confirm');
                }else{
                    $this->setView('index');
                    $this->view->set('title', 'There was an error login the data!');
                    $this->view->set('formData', $_POST);
                    $this->view->set('saveError', $result['result_details']);
                }
            }else{
                $this->setView('index');
                $this->view->set('title', 'Invalid form data!');
                $this->view->set('errors', $valid['errors']);
                $this->view->set('formData', $_POST);
            }
        return $this->view->output();
        } else {
            
        }
        
    }

    /**
     * The login action, when you do employees/login
     * If login is false , output errors
     * Else create Session to save info user login
     * And call function getListEmployees
     */
    function login()
    {
        // If user not press button submit login form , so return page Login Form
        if (!isset($_POST['loginFormSubmit']))
        {
            header('Location: ' . BASE_PATH . 'employees/index');
        }

        // Array save errors when validate.
        $errors = array();
        $check = true;

        // Get value user input 
        $username = isset($_POST['username']) ? trim($_POST['username']) : NULL;
        $password = isset($_POST['password']) ? trim($_POST['password']) : NULL;

        // User not enter username
        if (empty($username))
        {
            $check = false;
            array_push($errors, "Users name is required!");
        }

        // User not enter password
        if (empty($password))
        {
            $check = false;
            array_push($errors, "Password is required!");
        }

        // If $check is false , output errors
        if (!$check)
        {
            $this->setView('index');
            $this->view->set('title', 'Invalid form data!');
            $this->view->set('errors', $errors);
            $this->view->set('formData', $_POST);
            return $this->view->output();
        }

        try 
        {
            // Password encrypt by SHA-2 
            $password = hash('SHA256',$password);
    
            // Create Employees model object
            $employee = new EmployeesModel();
            
            // Call login() method in the EmployeesModel, put the result in $employee (false or user data) 
            $result = $employee->login($username,$password);

            // Check result returned
            if($result)
            {
                // Login success, write the user data into session
                Session::init();
                Session::set('user_logged_in', true);
                Session::set('user_id', $result['id']);
                Session::set('firstname', $result['firstname']);
                Session::set('lastname', $result['lastname']);
                Session::set('fullname', $result['firstname']." ".$result['lastname']);
                Session::set('employeetype_id', $result['employeetype_id']);
                
                // Redirect user to page list all Employees
                header('location: ' . BASE_PATH . 'employees/listemployees');
            }
        }
        catch (Exception $e) 
        {
            $this->setView('login');
            $this->view->set('title', 'There was an error login the data!');
            $this->view->set('formData', $_POST);
            $this->view->set('saveError', $e->getMessage());
        }

        return $this->view->output();
    }

    /**
     * The logout action, users/logout
     */
    function logout()
    {
        // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
        Auth::handleLogin();
        
        // Create Employees model object
        $employee = new EmployeesModel();
        $employee->logout();
        // redirect user to base URL
        header('location: ' . BASE_PATH);
    }
    
    /**
     * Get list all employees (users)
     */
    function listemployees()
    {
        // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
        Auth::handleLogin();
        
        // Create Employees model object
        $employee = new EmployeesModel();
        $listemployees = $employee->getAllEmployees();
        
        $this->setView('listemployees');
        $this->view->set('title', 'List all information of employees');
        $this->view->set('listemployees', $listemployees);
        return $this->view->output();
    }

    /**
     * Get detail infomation employee by user_id
     */
    function salary($user_id){
        // Auth::handleLogin() makes sure that only logged in users can use this action/method and see that page
        Auth::handleLogin();
        
        try {
            // Create Employees model object
            $employee = new EmployeesModel();
            $employeeDetail = $employee->getEmployeeById($user_id);

            // Check result returned
            if ($employeeDetail)
            {
                $this->setView('salary');
                $this->view->set('title', 'Salary calculation');
                $this->view->set('employee', $employeeDetail);

                // Get Employee type name
                $employeetype = $employee->getEmployeetypeByUserId($user_id);
                if ($employeetype)
                {
                    $this->view->set('employeetype', $employeetype);
                }
                else
                {
                    $this->view->set('employeetype', 'Not value');
                }
                
                // If user not press button submit salary form , so return page Salary Form
                if (isset($_POST['saveFormSubmit']))
                {
                    // Array save errors when validate.
                    $errors = array();
                    $check = true;
                    
                    // Array save infomation data
                    $arrData = array(); 
                    
                    // Get value salary input 
                    $user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : NULL;
                    $employeetype_id = isset($_POST['employeetype_id']) ? trim($_POST['employeetype_id']) : NULL;
                    $comment = isset($_POST['comment']) ? trim ($_POST['comment']) : "";
                    
                    // Add info into $arrData
                    $arrData = array($user_id,$comment);  
                    
                    // If Employee Type is Employee Normal
                    if($employeetype_id == 1) 
                    {
                        // Get normal salary input
                        $normal_salary = isset($_POST['normal_salary']) ? trim($_POST['normal_salary']) : NULL;
                        
                        // Create object corresponding Employee Normal Model 
                        $salary = new EmployeesNormalModel();
                        
                        // Call function calculate gross salary
                        $gross_salary = $salary->calculateGrossSalary($normal_salary);
                        
                        // Push more info into $arrData
                        array_push($arrData,$normal_salary,$gross_salary); 
                    }
                    // If Employee Type is Employee Hourly 
                    else if($employeetype_id == 2) 
                    {
                        // Get worked hour input
                        $worked_hour = isset($_POST['worked_hour']) ? trim($_POST['worked_hour']) : NULL;
                        // Get wageper hour input
                        $wageper_hour = isset($_POST['wageper_hour']) ? trim($_POST['wageper_hour']) : NULL;
                
                        // Create object corresponding Employee Hourly Model 
                        $salary = new EmployeesHourlyModel();
                        
                        // Call function calculate gross salary
                        $gross_salary = $salary->calculateGrossSalary($worked_hour,$wageper_hour);
                        
                        // Push more info into $arrData
                        array_push($arrData,$wageper_hour,$worked_hour,$gross_salary);
                    }
                    // If Employee Type is Employee Sale ($employeetype_id == 3)
                    else {
                        // Get basic salary input
                        $basic_salary = isset($_POST['basic_salary']) ? trim( $_POST['basic_salary']) : NULL;
                        // Get gross sale input
                        $gross_sale = isset($_POST['gross_sale']) ? trim($_POST['gross_sale']) : NULL;
                        // Get commission rate input
                        $commission_rate = isset($_POST['commission_rate']) ? trim($_POST['commission_rate']) : NULL;
                        
                        // Create object corresponding Employee Sale Model
                        $salary = new EmployeesSaleModel();
                        
                        // Call function calculate gross salary
                        $gross_salary = $salary->calculateGrossSalary($basic_salary,$gross_sale,$commission_rate);
                        
                        // Push more info into $arrData
                        array_push($arrData,$basic_salary,$gross_sale,$commission_rate,$gross_salary);
                    }
                    
                    /**
                     * Check value are not empty and not invalid
                     */
                    // User id is not exist
                    if (empty($user_id))
                    {
                        $check = false;
                        array_push($errors, "User id is not exist!");
                    }
            
                    // Employee type is not exist
                    if (empty($employeetype_id))
                    {
                        $check = false;
                        array_push($errors, "Employee type is not exist!");
                    }
                    
                    // Normal salary is required
                    if (isset($normal_salary))
                    {
                        if(empty($normal_salary))
                        {
                            $check = false;
                            array_push($errors, "Normal salary is required!");
                        }
                        else if(!is_numeric($normal_salary)) 
                        {
                            $check = false;
                            array_push($errors, "Normal salary is not numeric!");
                        }
                    }
                    
                    // Basic salary is required
                    if (isset($basic_salary))
                    {
                        if(empty($basic_salary))
                        {
                            $check = false;
                            array_push($errors, "Basic salary is required!");
                        }
                        else if(!is_numeric($basic_salary))
                        {
                            $check = false;
                            array_push($errors, "Basic salary is not numeric!");
                        }
                    }
                    
                    // Gross sale is required
                    if (isset($gross_sale))
                    {
                        if(empty($gross_sale))
                        {
                            $check = false;
                            array_push($errors, "Gross sale is required!");
                        }
                        else if(!is_numeric($gross_sale))
                        {
                            $check = false;
                            array_push($errors, "Gross sale is not numeric!");
                        }
                    }
                    
                    // Commission rate is required
                    if (isset($commission_rate))
                    {
                        if(empty($commission_rate))
                        {
                            $check = false;
                            array_push($errors, "Commission rate is required!");
                        }
                        /*
                        else if(!is_float($commission_rate))
                        {
                            $check = false;
                            array_push($errors, "Commission rate is not float!");
                        }
                        */
                    }
                    
                    // Hourly Work is required
                    if (isset($worked_hour))
                    {
                        if(empty($worked_hour))
                        {
                            $check = false;
                            array_push($errors, "Hourly work is required!");
                        }
                        else if(!is_numeric($worked_hour))
                        {
                            $check = false;
                            array_push($errors, "Hourly work is not numeric!");
                        }
                    }
                    
                    // Wage Per Hour is required
                    if (isset($wageper_hour))
                    {
                        if(empty($wageper_hour))
                        {
                            $check = false;
                            array_push($errors, "Wage per hour is required!");
                        }
                        else if(!is_numeric($wageper_hour))
                        {
                            $check = false;
                            array_push($errors, "Wage per hour is not numeric!");
                        }
                    }
                    
                    // Comment is not empty
                    if (empty($comment))
                    {
                        $check = false;
                        array_push($errors, "Comment is not empty!");
                    }
            
                    // If $check is false , output errors
                    if (!$check)
                    {
                        $this->setView('salary');
                        $this->view->set('title', 'Invalid form data!');
                        $this->view->set('errors', $errors);
                        $this->view->set('employee', $employeeDetail);
                        $this->view->set('employeetype', $employeetype);
                        $this->view->set('formData', $_POST);
                        return $this->view->output();
                    }
                    else 
                    {
                        // Get Salary Before Tax
                        $beforeTax_salary = $salary->calculateSalaryBeforeTax($gross_salary);

                        // Get Net Salary
                        $net_salary = $salary->calculateNetSalary($beforeTax_salary);
                        
                        // Push more info into $arrData
                        array_push($arrData,$net_salary);
                        
                        // Save all infomation to tbl_weeklysalary
                        $result_insert = $salary->insert($arrData);
                        
                        // Redirect to salary page
                        $this->setView('salary');
                        $this->view->set ( 'title', 'Store success!' );
                        $this->view->set('employee', $employeeDetail);
                        $this->view->set('employeetype', $employeetype);
                        return $this->view->output();
                    }
                }
            }
        }
        catch (Exception $e) 
        {
            $this->setView('listemployees');
            $this->view->set('title', 'Employee is not exist');
        }

        return $this->view->output();
    }
}