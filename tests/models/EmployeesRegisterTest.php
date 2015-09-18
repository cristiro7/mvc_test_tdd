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
 * I. Test Input Name.
 * 1) Input is FullwidthKatakana characters
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
 * II. Test Input phone.
 * - Should return false when input phone contain character alpha (090-999-454a)
 * - Should return false when input phone have first character is "-" (-09-999-4542)
 * - Should return false when input phone is incorrect format  (090-9993-4544)
 * - Should return false when input phone is incorrect format  (0906-999-4544)
 * - Should return false when input phone is incorrect format  (090-999-45444)
 * - Should return false when input phone contain symbol (090@-999-4543)
 * - Should return false when input phone contain point (090-999-454.)
 * 
 * - Should return true when input phone is correct format (090-911-1991)
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
