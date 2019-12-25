<?php
include_once 'database.php';
class xl_sach extends Database
{
    function danh_sach_tat_ca_sach()
    {
        $lenh_sql = "SELECT * FROM bs_sach";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function danh_sach_sach_noi_bat()
    {
        $lenh_sql = "SELECT s.*, tg.ten_tac_gia FROM bs_sach s, bs_tac_gia tg WHERE s.id_tac_gia = tg.id AND noi_bat = 1";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function danh_sach_sach_moi(){
        $lenh_sql = "SELECT s.*, tg.ten_tac_gia FROM bs_sach s, bs_tac_gia tg WHERE s.id_tac_gia = tg.id ORDER BY s.id DESC LIMIT 0,8";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function danh_sach_sach_ban_chay_nhat_theo_thoi_gian($ngay_bat_dau, $ngay_ket_thuc){
        $lenh_sql = "SELECT s.*, tg.ten_tac_gia, sum(so_luong) as tong_so_luong , sum(thanh_tien) as tong_tien
        FROM bs_sach s, bs_tac_gia tg, bs_chi_tiet_don_hang ctdh, bs_don_hang dh
        WHERE s.id_tac_gia = tg.id AND s.id = ctdh.id_sach AND dh.id = ctdh.id_don_hang
        AND dh.trang_thai > 0
        AND ngay_dat BETWEEN '$ngay_bat_dau' AND '$ngay_ket_thuc'
        GROUP BY s.id 
        ORDER BY tong_so_luong DESC, tong_tien DESC LIMIT 0,8";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function dem_so_sach_theo_loai($id_loai_sach){
        //kiem tra xem có loai sach con hay khong
        $lenh_sql = "SELECT id FROM bs_loai_sach WHERE id_loai_cha = $id_loai_sach";
        $this->setQuery($lenh_sql);
        $ds_loai_sach_con = $this->loadAllRow();

        if($ds_loai_sach_con)
        {
            //noi chuoi tao list loai con
            $chuoi_loai_con  = "";
            foreach($ds_loai_sach_con as $loai_con)
            {
                $chuoi_loai_con .= $loai_con->id.",";
            }
            $chuoi_loai_con = trim($chuoi_loai_con,",");

            $lenh_sql = "SELECT count(*) as so_sach FROM bs_sach WHERE id_loai_sach IN ($chuoi_loai_con)";
        }
        else
        {
            $lenh_sql = "SELECT count(*) as so_sach FROM bs_sach WHERE id_loai_sach = $id_loai_sach";
        }
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function danh_sach_sach_theo_loai($id_loai_sach, $bat_dau = 0, $so_luong_hien_thi){
        //kiem tra xem có loai sach con hay khong
        $lenh_sql = "SELECT id FROM bs_loai_sach WHERE id_loai_cha = $id_loai_sach";
        $this->setQuery($lenh_sql);
        $ds_loai_sach_con = $this->loadAllRow();

        if($ds_loai_sach_con)
        {
            //noi chuoi tao list loai con
            $chuoi_loai_con  = "";
            foreach($ds_loai_sach_con as $loai_con)
            {
                $chuoi_loai_con .= $loai_con->id.",";
            }
            $chuoi_loai_con = trim($chuoi_loai_con,",");

            $lenh_sql = "SELECT s.*, tg.ten_tac_gia FROM bs_sach s, bs_tac_gia tg WHERE s.id_tac_gia = tg.id AND id_loai_sach IN ($chuoi_loai_con)  ORDER BY s.id DESC LIMIT $bat_dau,$so_luong_hien_thi";
        }
        else
        {
            $lenh_sql = "SELECT s.*, tg.ten_tac_gia FROM bs_sach s, bs_tac_gia tg WHERE s.id_tac_gia = tg.id AND id_loai_sach = $id_loai_sach  ORDER BY s.id DESC LIMIT $bat_dau,$so_luong_hien_thi";
        }
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function thong_tin_sach_theo_id($id_sach){
        $lenh_sql = "SELECT s.*, tg.ten_tac_gia, nxb.ten_nha_xuat_ban, ls.ten_loai_sach 
        FROM bs_sach s, bs_tac_gia tg, bs_nha_xuat_ban nxb, bs_loai_sach ls 
        WHERE s.id_nha_xuat_ban = nxb.id AND s.id_tac_gia = tg.id AND ls.id = s.id_loai_sach
        AND s.id = $id_sach";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function them_sach_moi($ten_sach, $id_tac_gia, $gioi_thieu, $doc_thu, $id_loai_sach, $id_nha_xuat_ban, $so_trang,
    $ngay_xuat_ban, $kich_thuoc, $sku, $trong_luong, $trang_thai, $hinh, $don_gia, $gia_bia, $noi_bat)
    {
        $ten_sach = str_replace("'","&rsquo;",str_replace('"',"&quot;",$ten_sach));
        $gioi_thieu = str_replace("'","&rsquo;",str_replace('"',"&quot;",$gioi_thieu));
        $lenh_sql = "INSERT INTO bs_sach(ten_sach, id_tac_gia, gioi_thieu, doc_thu, id_loai_sach, id_nha_xuat_ban, so_trang,
    ngay_xuat_ban, kich_thuoc, sku, trong_luong, trang_thai, hinh, don_gia, gia_bia, noi_bat)
                        VALUES('$ten_sach', '$id_tac_gia', '$gioi_thieu', '$doc_thu', '$id_loai_sach', '$id_nha_xuat_ban', '$so_trang',
    '$ngay_xuat_ban', '$kich_thuoc', '$sku', '$trong_luong', '$trang_thai', '$hinh', '$don_gia', '$gia_bia', '$noi_bat');";
        //echo $lenh_sql."<br/>";
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function cap_nhat_sach($id_sach, $ten_sach, $id_tac_gia, $gioi_thieu, $doc_thu, $id_loai_sach, $id_nha_xuat_ban, $so_trang,
    $ngay_xuat_ban, $kich_thuoc, $sku, $trong_luong, $trang_thai, $hinh, $don_gia, $gia_bia, $noi_bat)
    {
        $ten_sach = str_replace("'","&rsquo;",str_replace('"',"&quot;",$ten_sach));
        $gioi_thieu = str_replace("'","&rsquo;",str_replace('"',"&quot;",$gioi_thieu));
        $lenh_sql = "UPDATE  bs_sach SET 
                    ten_sach = '$ten_sach',
                    id_tac_gia = '$id_tac_gia',
                    gioi_thieu = '$gioi_thieu',
                    doc_thu = '$doc_thu',
                    id_loai_sach = '$id_loai_sach',
                    id_nha_xuat_ban = '$id_nha_xuat_ban',
                    so_trang = '$so_trang',
                    ngay_xuat_ban = '$ngay_xuat_ban',
                    kich_thuoc = '$kich_thuoc',
                    sku = '$sku',
                    trong_luong = '$trong_luong',
                    trang_thai = '$trang_thai',
                    hinh = '$hinh',
                    don_gia = '$don_gia',
                    gia_bia = '$gia_bia',
                    noi_bat = '$noi_bat'
                    WHERE id = '$id_sach'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function xoa_sach_theo_id($id_sach)
    {
        $lenh_sql = "DELETE FROM bs_sach WHERE id = '$id_sach'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }
}
?>