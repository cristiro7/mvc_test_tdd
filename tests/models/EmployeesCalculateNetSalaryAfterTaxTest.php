<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");

/**
 * EmployeesCalculateNetSalaryAfterTaxTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesCalculateNetSalaryAfterTaxTest extends PHPUnit_Framework_TestCase
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
     * Test case salary before tax is zero
     */
    public function testsfEmployeesCalculateNetSalaryAfterTax_SalaryBeforeTaxIsZero()
    {
        // Give the context
        $this->expected = 0;
    
        // When the cause (trigger)
        $beforeTax_salary = 0;
        $this->actual = $this->employee->calculateNetSalary($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is less than 5000
     */
    public function testsfEmployeesCalculateNetSalaryAfterTax_SalaryBeforeTaxIsLessThan5000()
    {
        // Give the context
        $this->expected = 950;
        
        // When the cause (trigger)
        $beforeTax_salary = 1000;
        $this->actual = $this->employee->calculateNetSalary($beforeTax_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is between 5000 and 10000
     */
    public function testsfEmployeesCalculateNetSalaryAfterTax_SalaryBeforeTaxIsBetween5000And10000()
    {
        // Give the context
        $this->expected = 7200;
    
        // When the cause (trigger)
        $beforeTax_salary = 8000;
        $this->actual = $this->employee->calculateNetSalary($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is between 10000 and 20000
     */
    public function testsfEmployeesCalculateNetSalaryAfterTax_SalaryBeforeTaxIsBetween10000And20000()
    {
        // Give the context
        $this->expected = 12750;
    
        // When the cause (trigger)
        $beforeTax_salary = 15000;
        $this->actual = $this->employee->calculateNetSalary($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is greater than 20000
     */
    public function testsfEmployeesCalculateNetSalaryAfterTax_SalaryBeforeTaxIsGreaterThan20000()
    {
        // Give the context
        $this->expected = 22000;
    
        // When the cause (trigger)
        $beforeTax_salary = 22000;
        $this->actual = $this->employee->calculateNetSalary($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
