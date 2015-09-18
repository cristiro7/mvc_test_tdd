<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");
require_once($HOME . "/models/EmployeesNormalModel.php");

/**
 * EmployeesNormal_InsertWeeklySalaryTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesNormal_InsertWeeklySalaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up data for testcase. in this case it inital EmployeesNormalModel
     */
    protected function setUp() {
        $this->employee = new EmployeesNormalModel();
    }
    
    /**
     * This function used to erase data which we have created inside setUp function.
     */
    protected function tearDown() {
    
    }
    
    /**
     * Test case insert salary is success and match infomation
     */
    public function testsfEmployeesNormal_IsertSalaryIsSuccessAndMatchInfomation()
    {
        // Give the context
        $this->expected = array(
            'user_id'             => 1,
            'basic_salary'        => 200,
            'worked_hour'         => '',
            'gross_sale'          => '',
            'commission_rate'     => '',
            'gross_salary'        => 200,
            'net_salary'          => 180,
            'comment'             => 'Test insert'
        );
        
        // When the cause (trigger)
        $arrData = array(1, 'Test insert', 200, 200, 180);
        
        // Get last id just insert success
        $lastID = $this->employee->insert($arrData);

        // Get detail weekly salary by id
        $this->actual = $this->employee->getDetailWeeklySalaryById($lastID);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case insert salary is success and not match infomation
     */
    public function testsfEmployeesNormal_IsertSalaryIsSuccessAndNotMatchInfomation()
    {
        // Give the context
        $this->expected = array(
                'user_id'             => 1,
                'basic_salary'        => 200,
                'worked_hour'         => '',
                'gross_sale'          => '',
                'commission_rate'     => '',
                'gross_salary'        => 200,
                'net_salary'          => 180,
                'comment'             => 'Test insert'
        );
    
        // When the cause (trigger)
        $arrData = array(1, 'Test insert', 200, 200, 200);
    
        // Get last id just insert success
        $lastID = $this->employee->insert($arrData);
    
        // Get detail weekly salary by id
        $this->actual = $this->employee->getDetailWeeklySalaryById($lastID);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case insert salary is failure
     */
    public function testsfEmployeesNormal_IsertSalaryIsFailure()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        $arrData = array(1, 'Test insert', 200, 200, 'abc');
    
        // Get last id just insert success
        $lastID = $this->employee->insert($arrData);
    
        // Get detail weekly salary by id
        $this->actual = $this->employee->getDetailWeeklySalaryById($lastID);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
