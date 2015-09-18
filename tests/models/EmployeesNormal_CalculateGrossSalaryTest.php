<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");
require_once($HOME . "/models/EmployeesNormalModel.php");

/**
 * EmployeesNormal_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesNormal_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
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
     * Test case normal salary is zero
     */
    public function testsfEmployeesNormal_NormalSalaryIsZero()
    {
        // Give the context
        $this->expected = 0;
        
        // When the cause (trigger)
        $normal_salary = 0;
        $this->actual = $this->employee->calculateGrossSalary($normal_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case normal salary is greater than zero and is interger
     */
    public function testsfEmployeesNormal_NormalSalaryIsGreaterThanZeroAndIsInterger()
    {
        // Give the context
        $this->expected = 100;
        
        // When the cause (trigger)
        $normal_salary = 100;
        $this->actual = $this->employee->calculateGrossSalary($normal_salary);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case normal salary is greater than zero and is float
     */
    public function testsfEmployeesNormal_NormalSalaryIsGreaterThanZeroAndIsFloat()
    {
        // Give the context
        $this->expected = 200;
    
        // When the cause (trigger)
        $normal_salary = 200.5;
        $this->actual = $this->employee->calculateGrossSalary($normal_salary);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
