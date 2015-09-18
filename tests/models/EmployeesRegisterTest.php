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
 *   
 * Test cases for KhanhVu:
 * 4/ Kanji Lv3
 * 
 * 5/ Kanji Lv4
 * 
 * 6/ Contain Kanji
 * 
 * * Test cases for khoa.td
 * 7) Input contain hiragana
 * 8) Input contain Alpha 1 byte
 * 9) Contain Prohibited Character
 * 
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
     * @author khoa.td
     * Test input Hiragana to username
     */
    public function testInputHiragana(){
        // Give the context
        $this->expected = true;
        // When inputed is Hiragana
        $this->employee->setName("ゞほ");
        $this->actual = $this->employee->checkNameIsHiragana();
        // Then function checkNameIsHiragana return true
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test User register by name input is FullwidthKatakana characters
     */
    public function testsfEmployeesRegister_NameInputIsFullwidthKatakanaChars()
    {
        // Give the context
        $this->expected = true;
    
        // When the cause (trigger)
        $name = 'テュアン';
        $this->actual = $this->employee->checkInputIsFullwidthKatakanaChars($name);
    
        // Then the effect (assertion)
        $this->assertEquals($this->expected, $this->actual);
    }
    
    /**
     * Test input Hiragana to username
     */
    public function testInputHiragana(){
    	 // Give the context
    	 // When
    	 // Then
    }
    
    /**
     * @author:Khanh
     * Test Input Kanji Lv3 -- Should return false
     */
    
    function testShouldReturnFalseWhenInputKanjiLv3(){
        // Given
        $input = '篗';
        // When
        $rerult = $this->employee->checkInputIsFullwidthKatakanaChars($input);
        // Then
        $this->assertFalse($rerult);
    }
    
    /**
     * @author:Khanh
     * Test Input Kanji Lv4 -- Should return false
     */
    
    function testShouldReturnFalseWhenInputKanjiLv4(){
        // Given
        $input = '㥯';
        // When
        $rerult = $this->employee->checkInputIsFullwidthKatakanaChars($input);
        // Then
        $this->assertFalse($rerult);
    }
    
    /**
     * @author:Khanh
     * Test Input String contain Kanji -- Should return false
     */
    
    function testShouldReturnFalseWhenInputStringContainKanji(){
        // Given
        $input = 'ウ已';
        // When
        $rerult = $this->employee->checkInputIsFullwidthKatakanaChars($input);
        // Then
        $this->assertFalse($rerult);
    }
}
