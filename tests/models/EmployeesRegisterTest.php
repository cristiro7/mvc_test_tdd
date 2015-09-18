<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");

/**
 * EmployeesRegisterTest extends PHPUnit_Framework_TestCase
 *
 * This class extends phpUnit.
 * @author ThuanNguyen.
 *
 * Author               date(Year.Month.Day)        action
 * -------------------------------------------------------------------------
 * ThuanNguyen             2015.22.01               created
 *
 * To do List
 * 1) Test Input 
 *   + Input is FullwidthKatakana characters
 * 2) Kanji Lvl1
 *   +
 * 3) Kanji Lvl2
 *   +
 */

class EmployeesRegisterTest extends PHPUnit_Framework_TestCase
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
     * Test User login by password is not encrypted
     */
    public function testsfEmployeesRegister_PasswordIsNotEncrypted()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        $username = 'hieu';
        $password = 'hieu';
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
