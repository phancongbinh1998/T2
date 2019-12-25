<?php
include_once 'database.php';
class xl_tin_tuc extends Database
{
    function ds_tat_ca_tin_tuc()
    {
        $lenh_sql = "SELECT * FROM bs_tin_tuc";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function danh_sach_tin_tuc_hien_thi($bat_dau = 0, $so_luong = "")
    {
    	if($so_luong)
    	{
    		$lenh_sql = "SELECT * FROM bs_tin_tuc WHERE trang_thai = 1 LIMIT $bat_dau, $so_luong";
    	}
    	else
    	{
    		$lenh_sql = "SELECT * FROM bs_tin_tuc WHERE trang_thai = 1";
    	}
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function thong_tin_tin_tuc_theo_id($id_tin_tuc)
    {
        $lenh_sql = "SELECT * FROM bs_tin_tuc WHERE id = '$id_tin_tuc'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function them_tin_tuc_moi($tieu_de_tin, $hinh_dai_dien, $noi_dung_tom_tat, $noi_dung_chi_tiet, $trang_thai)
    {
        $ngay_hien_tai = date("Y-m-d H:i:s");
        $tieu_de_tin = str_replace("'","&rsquo;",str_replace('"',"&quot;",$tieu_de_tin));
        $noi_dung_tom_tat = str_replace("'","&rsquo;",str_replace('"',"&quot;",$noi_dung_tom_tat));
        $noi_dung_chi_tiet = str_replace("'","&rsquo;",str_replace('"',"&quot;",$noi_dung_chi_tiet));

        $lenh_sql = "INSERT INTO bs_tin_tuc(tieu_de_tin, hinh_dai_dien, noi_dung_tom_tat, noi_dung_chi_tiet, trang_thai, ngay_dang, id_loai_tin_tuc)
                        VALUES('$tieu_de_tin', '$hinh_dai_dien', '$noi_dung_tom_tat', '$noi_dung_chi_tiet', '$trang_thai', '$ngay_hien_tai', '1');";
        //echo $lenh_sql."<br/>";
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function cap_nhat_tin_tuc($id_tin_tuc, $tieu_de_tin, $hinh_dai_dien, $noi_dung_tom_tat, $noi_dung_chi_tiet, $trang_thai)
    {
        $tieu_de_tin = str_replace("'","&rsquo;",str_replace('"',"&quot;",$tieu_de_tin));
        $noi_dung_tom_tat = str_replace("'","&rsquo;",str_replace('"',"&quot;",$noi_dung_tom_tat));
        $noi_dung_chi_tiet = str_replace("'","&rsquo;",str_replace('"',"&quot;",$noi_dung_chi_tiet));
        $lenh_sql = "UPDATE  bs_tin_tuc SET 
                    tieu_de_tin = '$tieu_de_tin',
                    hinh_dai_dien = '$hinh_dai_dien',
                    noi_dung_tom_tat = '$noi_dung_tom_tat',
                    noi_dung_chi_tiet = '$noi_dung_chi_tiet',
                    trang_thai = '$trang_thai',
                    id_loai_tin_tuc = '1'
                    WHERE id = '$id_tin_tuc'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function xoa_tin_tuc_theo_id($id_tin_tuc_xoa)
    {
        $lenh_sql = "DELETE FROM bs_tin_tuc WHERE id = '$id_tin_tuc_xoa'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }
}
?>