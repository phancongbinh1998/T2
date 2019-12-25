<?php
include_once 'database.php';
class xl_nha_xuat_ban extends Database
{
    function danh_sach_tat_ca_nha_xuat_ban()
    {
        $lenh_sql = "SELECT * FROM bs_nha_xuat_ban";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }
}
?>