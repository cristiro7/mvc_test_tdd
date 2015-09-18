<?php
/**
 * Class EmployeesHourlyModel
 *
 * Handles calculate gross salary from Hourly Work and Wage Per Hour
 * Save infomation into tbl_weeklysalary
 */
class EmployeesHourlyModel extends EmployeesModel
{
	private $worked_hour;
    private $wageper_hour;
	
    /**
	 * Calculate gross salary
     * @param $worked_hour
     * @param $wageper_hour
	 * @return number
	 */
	public function calculateGrossSalary($worked_hour,$wageper_hour)
	{
        // If hours worked greater than 40, so employee will receive overtime pay 
        if($worked_hour > 40)
	    {
	        $gross_salary = $wageper_hour * 40 + ($worked_hour - 40) * $wageper_hour * 1.5;
	    }
        // Else only employee are paid by the hours worked 
	    else 
	    {
	    	$gross_salary = $wageper_hour * $worked_hour;
	    }
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
	    $sql = "INSERT INTO tbl_weeklysalary (user_id, comment, basic_salary, worked_hour, gross_salary, net_salary, created_date)
 				VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
	    
	    $data = array($arrData[0], $arrData[1], $arrData[2], $arrData[3], $arrData[4], $arrData[5]);
	    $sth = $this->db->prepare($sql);
	    return $sth->execute($data);
	}
}
