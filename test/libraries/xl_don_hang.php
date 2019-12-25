<?php
include_once 'database.php';
class xl_don_hang extends Database
{
    function danh_sach_tat_ca_don_hang($lay_danh_sach_con = false)
    {
        $lenh_sql = "SELECT * FROM bs_don_hang";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        if($lay_danh_sach_con)
        {
            foreach($result as $item)
            {
                $item->ds_chi_tiet_don_hang = $this->danh_sach_list_chi_tiet_don_hang_theo_id_don_hang($item->id);
            }
        }

        return $result;
    }

    function danh_sach_list_chi_tiet_don_hang_theo_id_don_hang($id_don_hang)
    {
        $lenh_sql = "SELECT * FROM bs_chi_tiet_don_hang ctdh, bs_sach s WHERE s.id = ctdh.id_sach AND id_don_hang = '$id_don_hang'";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function thong_tin_nguoi_dung_theo_ten_dang_nhap($ten_dang_nhap)
    {
        $lenh_sql = "SELECT * FROM bs_nguoi_dung WHERE tai_khoan = '$ten_dang_nhap'";
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

    function them_don_hang($tong_tien,$ho_ten_nguoi_nhan,$email_nguoi_nhan,$so_dien_thoai_nguoi_nhan,$dia_chi_nguoi_nhan,$id_nguoi_dung)
    {
    	$ngay_hien_tai = date("Y-m-d H:i:s");
    	$lenh_sql = "INSERT INTO bs_don_hang(tong_tien, ho_ten_nguoi_nhan, email_nguoi_nhan, so_dien_thoai_nguoi_nhan, dia_chi_nguoi_nhan, id_nguoi_dung, ngay_dat, trang_thai) 
			VALUES('$tong_tien', '$ho_ten_nguoi_nhan', '$email_nguoi_nhan', '$so_dien_thoai_nguoi_nhan', '$dia_chi_nguoi_nhan', '$id_nguoi_dung', '$ngay_hien_tai', '2') ";
		//echo $lenh_sql;
		$this->setQuery($lenh_sql);
		$this->execute();
        //echo $this->getLastId();
        //lấy id vừa thêm vào
        $result = $this->getLastId();
		return $result;
    }

    function them_chi_tiet_don_hang($id_don_hang, $id_san_pham, $so_luong, $don_gia, $thanh_tien)
    {
        //$ngay_hien_tai = date("Y-m-d H:i:s");
        $lenh_sql = "INSERT INTO bs_chi_tiet_don_hang(id_don_hang, id_sach, so_luong, don_gia, thanh_tien)
            VALUES('$id_don_hang', '$id_san_pham', '$so_luong', '$don_gia', '$thanh_tien') ";
        //echo $lenh_sql."<br/>";
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function xoa_don_hang_theo_id($id_don_hang_xoa)
    {
        $lenh_sql = "DELETE FROM bs_don_hang WHERE id = '$id_don_hang_xoa'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        if($result)
        {
            $this->xoa_tat_ca_chi_tiet_don_hang_theo_don_hang($id_don_hang_xoa);
        }
        return $result;
    }

    function xoa_tat_ca_chi_tiet_don_hang_theo_don_hang($id_don_hang_xoa)
    {
        $lenh_sql = "DELETE FROM bs_chi_tiet_don_hang WHERE id_don_hang = '$id_don_hang_xoa'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function thong_tin_don_hang_theo_id($id_don_hang)
    {
        $lenh_sql = "SELECT * FROM bs_don_hang WHERE id = $id_don_hang";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        $result->ds_chi_tiet_don_hang = $this->danh_sach_list_chi_tiet_don_hang_theo_id_don_hang($id_don_hang);
        return $result;
    }

    function cap_nhat_don_hang($id_don_hang, $trang_thai)
    {
        $lenh_sql = "UPDATE  bs_don_hang SET 
                    trang_thai = '$trang_thai'
                    WHERE id = '$id_don_hang'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function template_mail_thanh_toan($mang_gio_hang){
         $ho_ten = $_POST["ho_ten"];
         $email = $_POST["email"];
         $dien_thoai = $_POST["dien_thoai"];
         $dia_chi = $_POST["dia_chi"];
         
        foreach($mang_gio_hang as $mat_hang)
        {
            $tong_tien += $mat_hang->so_luong * $mat_hang->don_gia;
            $chuoi_ds .= '<tr>
                <td>'.$mat_hang->sku.'</td>
                <td style="min-width: 80px;"><a href="chi_tiet_sach.php?id_sach='.$mat_hang->id.'">'.$mat_hang->ten_sach.'</a></td>
                <td>
                    <img width="200" src="http://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '/../images/sach/'.$mat_hang->hinh.'" />
                </td>
                <td>'.number_format($mat_hang->don_gia,0,",",".").'</td>
                <td style="text-align:center;">'.$mat_hang->so_luong.'</td>
                <td style="text-align: right;">'.number_format($mat_hang->so_luong * $mat_hang->don_gia,0,",",".").' ₫</td>
            </tr>';
        }
        
        return '<meta charset="utf-8" />
        <!-- Latest compiled and minified CSS & JS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

        <h1>
            Cám ơn bạn đã mua sách từ chúng tôi!
        </h1>


        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">THÔNG TIN NHẬN SÁCH</h2>
        <div class="col-md-12 col-lg-12" style="margin: 20px">
            <div class="row">
                <div class="col-md-3">
                    Họ tên:
                </div>
                <div class="col-md-9">
                    '.$ho_ten.'
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Email:
                </div>
                <div class="col-md-9">
                    '.$email.'
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Điện thoại:
                </div>
                <div class="col-md-9">
                    '.$dien_thoai.'
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Địa chỉ:
                </div>
                <div class="col-md-9">
                    '.$dia_chi.'
                </div>
            </div>
        </div>

        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>
        <table class="table table-hover gio_hang">
            <thead>
                <tr>
                    <th>Mã sách</th>
                    <th>Tên sách</th>
                    <th>Hình sách</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                '.$chuoi_ds.'
                <tr class="tong_tien">
                    <td colspan="4" style="text-align: right;">Tổng cộng: </td>
                    <td colspan="2" style="text-align: right;">
                        '.number_format($tong_tien,0,",",".").' ₫
                    </td>
                </tr>
            </tbody>
        </table>';
        
    }
}