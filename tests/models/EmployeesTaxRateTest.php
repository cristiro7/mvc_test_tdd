<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");

/**
 * EmployeesTaxRateTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesTaxRateTest extends PHPUnit_Framework_TestCase
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
     * Test case salary before tax is less than 5000, tax rate will be 5%
     */
    public function testsfEmployeesTaxRate_SalaryBeforeTaxIsLessThan5000()
    {
        // Give the context
        $this->expected = 5;
        
        // When the cause (trigger)
        $beforeTax_salary = 1000;
        $this->actual = $this->employee->calculateTaxRate($beforeTax_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is between 5000 and 10000, tax rate will be 10%
     */
    public function testsfEmployeesTaxRate_SalaryBeforeTaxIsBetween5000And10000()
    {
        // Give the context
        $this->expected = 10;
    
        // When the cause (trigger)
        $beforeTax_salary = 8000;
        $this->actual = $this->employee->calculateTaxRate($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is between 10000 and 20000, tax rate will be 15%
     */
    public function testsfEmployeesTaxRate_SalaryBeforeTaxIsBetween10000And20000()
    {
        // Give the context
        $this->expected = 15;
    
        // When the cause (trigger)
        $beforeTax_salary = 15000;
        $this->actual = $this->employee->calculateTaxRate($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case salary before tax is greater than 20000, tax rate will be 0%
     */
    public function testsfEmployeesTaxRate_SalaryBeforeTaxIsGreaterThan20000()
    {
        // Give the context
        $this->expected = 0;
    
        // When the cause (trigger)
        $beforeTax_salary = 22000;
        $this->actual = $this->employee->calculateTaxRate($beforeTax_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
