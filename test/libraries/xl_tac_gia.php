<?php
include_once 'database.php';
class xl_tac_gia extends Database
{
    function danh_sach_tat_ca_tac_gia()
    {
        $lenh_sql = "SELECT * FROM bs_tac_gia";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }
}
?>