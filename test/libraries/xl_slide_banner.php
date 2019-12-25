<?php
include_once 'database.php';
class xl_slide_banner extends Database
{
    function danh_sach_slide()
    {
        $lenh_sql = "SELECT * FROM bs_slide_banner WHERE trang_thai = 1";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function danh_sach_tat_ca_slide_banner()
    {
    	$lenh_sql = "SELECT * FROM bs_slide_banner";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function thong_tin_slide_banner_theo_id($id_slide_banner)
    {
		$lenh_sql = "SELECT * FROM bs_slide_banner WHERE id = $id_slide_banner";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function them_slide_banner_moi($ten_slide, $hinh, $trang_thai)
    {
        $lenh_sql = "INSERT INTO bs_slide_banner(ten_slide, hinh, trang_thai)
                        VALUES('$ten_slide', '$hinh', '$trang_thai');";
        //echo $lenh_sql."<br/>";
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function cap_nhat_slide_banner($id_slide, $ten_slide, $hinh, $trang_thai)
    {
        $lenh_sql = "UPDATE  bs_slide_banner SET 
                    ten_slide = '$ten_slide',
                    hinh = '$hinh',
                    trang_thai = '$trang_thai'
                    WHERE id = '$id_slide'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function xoa_slide_banner_theo_id($id_slide_banner)
    {
    	$lenh_sql = "DELETE FROM bs_slide_banner WHERE id = '$id_slide_banner'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }
}
?>