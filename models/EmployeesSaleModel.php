<?php
/**
 * Class EmployeesSaleModel
 *
 * Handles calculate gross salary from Basic Salary and Gross Sale and Commission Rate
 * Save infomation into tbl_weeklysalary
 */
class EmployeesSaleModel extends EmployeesModel
{
	private $basic_salary;
    private $gross_sale;
    private $commission_rate;
	
    /**
	 * Calculate gross salary
     * @param $basic_salary
     * @param $gross_sale
     * @param $commission_rate
	 * @return number
	 */
	public function calculateGrossSalary($basic_salary,$gross_sale,$commission_rate)
	{
        $gross_salary = $basic_salary + ($gross_sale * $commission_rate);	   
	    return (int)$gross_salary;	   
	}
	
	/**
	 * Save all infomation to table tbl_weeklysalary
	 *
	 * @param array $arrData
	 * @return array 
	 */
	public function insert($arrData)
	{
	    $sql = "INSERT INTO tbl_weeklysalary (user_id, comment, basic_salary, gross_sale, commission_rate, gross_salary, net_salary, created_date)
 				VALUES (?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
	    
	    $data = array($arrData[0], $arrData[1], $arrData[2], $arrData[3], $arrData[4], $arrData[5], $arrData[6]);
	    $sth = $this->db->prepare($sql);
	    return $sth->execute($data);
	}
}
