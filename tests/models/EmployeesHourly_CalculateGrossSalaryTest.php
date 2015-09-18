<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");
require_once($HOME . "/models/EmployeesHourlyModel.php");

/**
 * EmployeesHourly_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 */

class EmployeesHourly_CalculateGrossSalaryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Set up data for testcase. in this case it inital EmployeesHourlyModel
     */
    protected function setUp() {
        $this->employee = new EmployeesHourlyModel();
    }
    
    /**
     * This function used to erase data which we have created inside setUp function.
     */
    protected function tearDown() {
    
    }
    
    /**
     * Test case hours worked is zero
     */
    public function testsfEmployeesHourly_HoursWorkedIsZero()
    {
        // Give the context
        $this->expected = 0;
        
        // When the cause (trigger)
        $worked_hour = 0;
        $wageper_hour = 10;
        $this->actual = $this->employee->calculateGrossSalary($worked_hour, $wageper_hour);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case hours worked is less than 40
     */
    public function testsfEmployeesHourly_HoursWorkedIsLessThan40()
    {
        // Give the context
        $this->expected = 180;
        
        // When the cause (trigger)
        $worked_hour = 30;
        $wageper_hour = 6;
        $this->actual = $this->employee->calculateGrossSalary($worked_hour, $wageper_hour);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case hours worked is equal 40
     */
    public function testsfEmployeesHourly_HoursWorkedIsEqual40()
    {
        // Give the context
        $this->expected = 240;
        
        // When the cause (trigger)
        $worked_hour = 40;
        $wageper_hour = 6;
        $this->actual = $this->employee->calculateGrossSalary($worked_hour, $wageper_hour);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test case hours worked is greater than 40
     */
    public function testsfEmployeesHourly_HoursWorkedIsGreaterThan40()
    {
        // Give the context
        $this->expected = 330;
    
        // When the cause (trigger)
        $worked_hour = 50;
        $wageper_hour = 6;
        $this->actual = $this->employee->calculateGrossSalary($worked_hour, $wageper_hour);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
