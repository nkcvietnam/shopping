<?php

namespace App\Http\Controllers\Backend;

use App\Http\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
use View;
use Session;
use Excel;

class UserController extends Controller
{
    // set data $this->user is model User
    public function __construct(User $user)
    {
        # code...
        $this->user = $user;
    }

    // Show list user
    public function index()
    {
        //lấy toàn bộ dữ liệu của bảng User
        $users = $this->user->get()->toArray();
        //compact('users') là truyền biến, và nhận qua view có cùng tên biến là $users
        return view('backend.user.index',compact('users'));
    }

    //create user
    public function create()
    {
        //lấy toàn bộ dữ liệu từ request
        $input = Input::all();
        if(!empty($input)){
            //tạo validator
            $validator = $this->user->validateCreate($input);

            //nếu xác nhận không thành công
            if($validator->fails()){
                return redirect('admin1/user/create')->withErrors($validator);
            }else{

                //nếu thêm thành công.
                if($this->user->saveUser($input)){
                    return redirect('admin1/user/index')->with('thongbao','Thêm thành công');
                }else{
                    return redirect('admin1/user/index')->with('thongbao','Không thành công');
                }
            }
        }
        return view('admin.user.create');
    }

    //hàm sửa user
    public function edit($id = '')
    {   
        //nếu không tồn tại id thì redirect về danh sách user 
        if(empty($id)){
            return redirect('admin1/user/index');
        }
        //lấy toàn bộ dữ liệu từ request
        $input = Input::all();
        //
        if(!empty($input)){
            $validator = $this->user->validateUpdate($input);

            if($validator->fails()){
                //quay lại trang edit
                return redirect()->back()->withErrors($validator);
            }else{
                if($a = $this->user->updateUser($input,$id)){
                    
                    return redirect()->route('admin.user.index')->with('thongbao','Sửa thành công');  
                }else{
                    return redirect()->route('admin.user.index')->with('thongbao','Sửa hông thành công');
                }
            }
        }
        //lấy 1 trường từ bảng User với id
        $user = $this->user->find($id);
        return view('admin.user.edit',compact('user'));
    }

    public function delete($id = '')
    {
    	# code...
        if(empty($id)){
            return redirect('admin1/user/index');
        }
        //lấy 1 trường từ bảng User với id
        $user = $this->user->find($id);
        if($user->delete()){
            return redirect('admin1/user/index')->with('thongbao','Xóa thành công');
        }
        else{
            return redirect('admin1/user/index')->with('thongbao','Xóa không thành công');
        }

    }

    //export danh sách người dùng
    public function exportExcel($value='')
    {
        # code...
        $data = $this->user->all();
        Excel::create('danh sách User', function($excel) use ($data){
            $excel->sheet('Sheetname', function($sheet) use ($data) {

                // set font with ->setStyle()
                // $sheet->setStyle(array(
                //     'font' => array(
                //         'name'      =>  'Calibri',
                //         'size'      =>  13,
                //         'bold'      =>  true
                //     )
                // ));

                // Manipulate first row
                // $sheet->row(1, array(
                //     'DANH SÁCH CHI TIẾT GIAO DỊCH'
                // ));
                //Auto Size
                $sheet->setAutoSize(true);
                //sheet border
                $sheet->setAllBorders('thin');
                // Sheet manipulation
                $sheet->setPageMargin(0.25);

                $sheet->loadView('admin.user.excel',['users'=>$data]);
            });
        })->export('xlsx');
    }
}
