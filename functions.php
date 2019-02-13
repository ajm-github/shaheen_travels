<?php
/*********************************************************
 * Aouther : Adnan Abbasi
 * Date: Feb 10 ,2019
 * Purpose: This is the Home page.
 * Requrire: function.php and AgetClass.php
 **************************************************************/
include_once("AgentClass.php");
//include_once("db_oo_connect.php");

function GetDbconnection()
{
    $dbConnection= new mysqli("localhost","admin","P@ssw0rd","travelexperts");

    if ($dbConnection->connect_errno) 
    {
    echo "Error number".$dbConnection->connect_error.PHP_EOL;
    
    }
    

    return $dbConnection;
}
function GetUsers()
{

    $user_array=file("loginInfo.txt");
    $users=array();
    foreach($user_array as $row)
    {
        $items=explode(',',$row);
        $users[trim($items[0])]=trim($items[1]);
        return $users;//it will return an associative arrray where users as key and value as password.
    }
}

// function GetCustomers()
// {
//     $oolink//link here with data base.
//     $custormers=array();
//     while($cust=$result->fetch_assoc())
//     {
// // $custormer=new Customer(
// //     //$cust["Customerid"], first name -----Agent id// the fields inside the bracket should be mantching with database fields.
// // 
// $custormers[]=$customer;)// each record is an object we are assigning it to an array .
// return thiscustomesarray;
//     }

// }

function CurrentTimeAndDate()
{
    //date_default_timezone_get() 
    $dateToday=Date("Y-m-d H:i:s"); 
    return $dateToday;
}

function AgentCreate ($agent_data_obj){
    //$agentObj=new Agent($id,$fname,$mname,$lname,$busPhone,$email,$agtposition,$agencyid);
    //$agent_data=array();
    $agent_data=$agent_data_obj->convertOBjtoArray();
    //print_r($agent_data);

    $id=$agent_data["AgentId"];
    $agtfname=$agent_data["AgtFirstName"];
    $midIni=$agent_data["AgtMiddleInitial"];
    $lastName=$agent_data["AgtLastName"];
    $agtBusPhone=$agent_data["AgtBusPhone"];
    $agtemail=$agent_data["AgtEmail"];
    $agtposition=$agent_data["AgtPosition"];
    $agencynId=$agent_data["AgencyId"];

    $dbh = GetDbconnection();
    $sql= "INSERT INTO agents(AgentId,
    AgtFirstName,
    AgtMiddleInitial,
    AgtLastname,
    AgtBusPhone,
    AgtEmail,
    AgtPosition,
    AgencyId) VALUES('$id','$agtfname','$midIni','$lastName','$agtBusPhone','$agtemail','$agtposition','$agencynId')";

$result=mysqli_query($dbh,$sql);
    
  
    
    //CloseDB($dbh);
    return $result;
}

?>