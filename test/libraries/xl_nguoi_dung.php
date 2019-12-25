<?php
include_once 'database.php';
class xl_nguoi_dung extends Database
{
    function thong_tin_nguoi_dung_theo_ten_dang_nhap($ten_dang_nhap)
    {
        $lenh_sql = "SELECT * FROM bs_nguoi_dung WHERE tai_khoan = '$ten_dang_nhap'";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function thong_tin_nguoi_dung_quan_tri_theo_ten_dang_nhap($ten_dang_nhap)
    {
        $lenh_sql = "SELECT * FROM bs_nguoi_dung WHERE tai_khoan = '$ten_dang_nhap' AND id_loai_user > 4";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function thong_tin_nguoi_dung_theo_email($email)
    {
        $lenh_sql = "SELECT * FROM bs_nguoi_dung WHERE email = '$email'";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function thong_tin_nguoi_dung_theo_id($id_nguoi_dung)
    {
        $lenh_sql = "SELECT * FROM bs_nguoi_dung WHERE id = '$id_nguoi_dung'";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function them_nguoi_dung($email,$tai_khoan,$mat_khau,$ho_ten,$ngay_sinh,$dia_chi,$avatar,$dien_thoai, $loai_user = 1)
    {
    	$mat_khau = md5($mat_khau);
    	$ngay_hien_tai = date("Y-m-d H:i:s");
    	$lenh_sql = "INSERT INTO bs_nguoi_dung(email,tai_khoan,mat_khau,ho_ten,ngay_sinh,dia_chi,avatar,dien_thoai,id_loai_user,ngay_dang_ky) 
    	 				VALUES('$email','$tai_khoan','$mat_khau','$ho_ten','$ngay_sinh','$dia_chi','$avatar','$dien_thoai','$loai_user','$ngay_hien_tai') ";
		//echo $lenh_sql;
		$this->setQuery($lenh_sql);
		$result = $this->execute();
		return $result;
    }

    function doi_mat_khau($id_nguoi_dung, $mat_khau_moi)
    {
        $mat_khau_moi = md5($mat_khau_moi);
        $lenh_sql = "UPDATE bs_nguoi_dung SET mat_khau = '$mat_khau_moi' WHERE id = '$id_nguoi_dung'";
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function danh_sach_tat_ca_nguoi_dung($lay_thong_tin_quyen_han = false)
    {
        if($lay_thong_tin_quyen_han)
        {
            $lenh_sql = "SELECT nd.*,lnd.ten_loai_nguoi_dung FROM bs_nguoi_dung nd, bs_loai_nguoi_dung lnd WHERE nd.id_loai_user = lnd.id";
        }
        else
        {
            $lenh_sql = "SELECT * FROM bs_nguoi_dung";
        }
        
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function cap_nhat_nguoi_dung($id_nguoi_dung,$email,$tai_khoan,$mat_khau,$ho_ten,$ngay_sinh,$dia_chi,$avatar,$dien_thoai, $id_loai_user)
    {
        $lenh_sql = "UPDATE  bs_nguoi_dung SET 
                    email = '$email',
                    tai_khoan = '$tai_khoan',
                    mat_khau = '$mat_khau',
                    ho_ten = '$ho_ten',
                    ngay_sinh = '$ngay_sinh',
                    dia_chi = '$dia_chi',
                    avatar = '$avatar',
                    dien_thoai = '$dien_thoai',
                    id_loai_user = '$id_loai_user'
                    
                    WHERE id = '$id_nguoi_dung'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function danh_sach_loai_nguoi_dung()
    {
        $lenh_sql = "SELECT * FROM bs_loai_nguoi_dung";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }
}