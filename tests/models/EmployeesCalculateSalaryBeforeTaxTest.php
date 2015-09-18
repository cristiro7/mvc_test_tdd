<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");

/**
 * EmployeesCalculateSalaryBeforeTaxTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesCalculateSalaryBeforeTaxTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up data for testcase. in this case it inital EmployeesModel
     */
    protected function setUp() {
        $this->employee = new EmployeesModel();
    }
    
    /**
     * This function used to erase data which we have created inside setUp function.
     */
    protected function tearDown() {
    
    }
    
    /**
     * Test case gross salary is zero
     */
    public function testsfEmployeesCalculateSalaryBeforeTax_GrossSalaryIsZero()
    {
        // Give the context
        $this->expected = 0;
        
        // When the cause (trigger)
        $gross_salary = 0;
        $this->actual = $this->employee->calculateSalaryBeforeTax($gross_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case gross salary is less than 2000
     */
    public function testsfEmployeesCalculateSalaryBeforeTax_GrossSalaryIsLessThan2000()
    {
        // Give the context
        $this->expected = 950;
        
        // When the cause (trigger)
        $gross_salary = 1000;
        $this->actual = $this->employee->calculateSalaryBeforeTax($gross_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case gross salary is between 2000 and 6000
     */
    public function testsfEmployeesCalculateSalaryBeforeTax_GrossSalaryIsBetween2000And6000()
    {
        // Give the context
        $this->expected = 4675;
    
        // When the cause (trigger)
        $gross_salary = 5000;
        $this->actual = $this->employee->calculateSalaryBeforeTax($gross_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case gross salary is between 6000 and 10000
     */
    public function testsfEmployeesCalculateSalaryBeforeTax_GrossSalaryIsBetween6000And10000()
    {
        // Give the context
        $this->expected = 7400;
    
        // When the cause (trigger)
        $gross_salary = 8000;
        $this->actual = $this->employee->calculateSalaryBeforeTax($gross_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case gross salary is greater than 10000
     */
    public function testsfEmployeesCalculateSalaryBeforeTax_GrossSalaryIsGreaterThan10000()
    {
        // Give the context
        $this->expected = 12000;
    
        // When the cause (trigger)
        $gross_salary = 12000;
        $this->actual = $this->employee->calculateSalaryBeforeTax($gross_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
