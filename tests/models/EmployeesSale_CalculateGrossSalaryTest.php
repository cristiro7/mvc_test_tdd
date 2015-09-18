<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");
require_once($HOME . "/models/EmployeesSaleModel.php");

/**
 * EmployeesSale_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesSale_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up data for testcase. in this case it inital EmployeesSaleModel
     */
    protected function setUp() {
        $this->employee = new EmployeesSaleModel();
    }
    
    /**
     * This function used to erase data which we have created inside setUp function.
     */
    protected function tearDown() {
    
    }
    
    /**
     * Test case commission rate is zero
     */
    public function testsfEmployeesSale_CommissionRateIsZero()
    {
        // Give the context
        $this->expected = 5000;
        
        // When the cause (trigger)
        $basic_salary = 5000;
        $gross_sale = 5000;
        $commission_rate = 0;
        $this->actual = $this->employee->calculateGrossSalary($basic_salary, $gross_sale, $commission_rate);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case commission rate is equal 1
     */
    public function testsfEmployeesSale_CommissionRateIsEqual1()
    {
        // Give the context
        $this->expected = 10000;
        
        // When the cause (trigger)
        $basic_salary = 5000;
        $gross_sale = 5000;
        $commission_rate = 1;
        $this->actual = $this->employee->calculateGrossSalary($basic_salary, $gross_sale, $commission_rate);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case commission rate is greater than 0 and less than 1
     */
    public function testsfEmployeesSale_CommissionRateIsGreaterThan0AndLessThan1()
    {
        // Give the context
        $this->expected = 400;
        
        // When the cause (trigger)
        $basic_salary = 150;
        $gross_sale = 5000;
        $commission_rate = 0.05;
        $this->actual = $this->employee->calculateGrossSalary($basic_salary, $gross_sale, $commission_rate);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
