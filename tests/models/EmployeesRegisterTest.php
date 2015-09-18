<?php
// Include file necessary
$HOME = realpath(dirname(__FILE__)) . "/../..";
require_once($HOME . "/config/config.php");
require_once($HOME . "/library/Database.php");
require_once($HOME . "/library/Model.php");
require_once($HOME . "/models/EmployeesModel.php");

/**
 * EmployeesLoginTest extends PHPUnit_Framework_TestCase
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

class EmployeesLoginTest extends PHPUnit_Framework_TestCase
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
    public function testsfEmployeesLogin_PasswordIsNotEncrypted()
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
    
    /**
     * Test User login by password is encrypted MD5
     */
    public function testsfEmployeesLogin_PasswordIsEncryptedMD5()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        $username = 'hieu';
        $password = md5('hieu');
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User login by password is encrypted SHA-2
     */
    public function testsfEmployeesLogin_PasswordIsNotEncryptedSHA2()
    {
        // Give the context
        $this->expected = array(
            'id'                   => 1,
            'employeetype_id'      => 1,
            'username'             => 'hieu',
            'password'             => 'afc8e16842061ea3dbb023bf5f08d1bc3a728429313fab0cba30f60954ff9064',
            'lastname'             => 'Hieu',
            'firstname'            => 'Nguyen',
            'isaccountant'         => 1
        );
    
        // When the cause (trigger)
        $username = 'hieu';
        // Password encrypt by SHA-2
        $password = hash("sha256", "hieu");
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User login by username and password is match
     */
    public function testsfEmployeesLogin_ByUserNameAndPasswordIsMatch()
    {
        // Give the context
        $this->expected = array(
            'id'                   => 1,
            'employeetype_id'      => 1,
            'username'             => 'hieu',
            'password'             => 'afc8e16842061ea3dbb023bf5f08d1bc3a728429313fab0cba30f60954ff9064',
            'lastname'             => 'Hieu',
            'firstname'            => 'Nguyen',
            'isaccountant'         => 1
        );
        
        // When the cause (trigger)
        // Password encrypt by SHA-2 
        $username = 'hieu';
        $password = hash("sha256", "hieu");
        $this->actual = $this->employee->login($username, $password);
        
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User login by username is not match
     */
    public function testsfEmployeesLogin_ByUserNameIsNotMatch()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        // Password encrypt by SHA-2
        $username = 'hieu1';
        $password = hash("sha256", "hieu");
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User login by password is not match
     */
    public function testsfEmployeesLogin_ByPasswordIsNotMatch()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        // Password encrypt by SHA-2
        $username = 'hieu';
        $password = hash("sha256", "hieu1");
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User login by username and password is not match
     */
    public function testsfEmployeesLogin_ByUserNameAndPasswordIsNotMatch()
    {
        // Give the context
        $this->expected = false;
    
        // When the cause (trigger)
        // Password encrypt by SHA-2
        $username = 'hieu1';
        $password = hash("sha256", "hieu1");
        $this->actual = $this->employee->login($username, $password);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
}
