<?php
/**
 * Class EmployeesNormalModel
 *
 * Handles calculate gross salary from normal salary
 * Save infomation into tbl_weeklysalary
 */
class EmployeesNormalModel extends EmployeesModel
{
    private $normal_salary;
	
	/**
	 * Calculate gross salary
     * @param $normal_salary
	 * @return number
	 */
	public function calculateGrossSalary($normal_salary)
	{
        $gross_salary = $normal_salary;	   
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
	    $sql = "INSERT INTO tbl_weeklysalary (user_id, comment, basic_salary, gross_salary, net_salary, created_date)
 				VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        
	    $data = array($arrData[0],$arrData[1],$arrData[2],$arrData[3],$arrData[4]);
        $sth = $this->db->prepare($sql);
		$sth->execute($data);
		return $this->db->lastInsertId();
	}
}