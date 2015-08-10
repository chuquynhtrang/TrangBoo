<?php
require_once 'Model/CategoryModel.php';
class CategoryController extends BaseController
{
    public function index()
    {
        if(isset($_GET['search'])) {
            $data = $this->indexBase('categories', 'CategoryModel', 'categoryname', HREFCATEGORY.'&search='.$_GET['search'].'&page=');
            $this->view('list-categories', $data);
        } else if(isset($_GET['sort'])){
            $data = $this->indexBase('categories', 'CategoryModel', 'categoryname', HREFCATEGORY.'&sort='.$_GET['sort'].'&order='.$_GET['order'].'&page=');
            $this->view('list-categories',$data);
        }
        else {
            $data = $this->indexBase('categories', 'CategoryModel', 'categoryname', HREFCATEGORY.'&page=');
            $this->view('list-categories', $data);
    }
    }

    public function viewAddCategory()
    {
        $this->view('add-category');
    }
    //controller add user
    public function addCategory()
    {
        $dt['categoryname'] = $_POST['categoryname'];
        $dt['activate'] = $_POST['activate'];
        $this->add('categories','CategoryModel',$dt);
        $md = new CategoryModel('categories');
        $dt = $md->getAll('*');
        $totalRecord = $dt->num_rows;
        $totalPage = ceil($totalRecord/NUMBER_RECORD);
        header('Location:'. HREFCATEGORY.'&page='.$totalPage);
    }

    public function viewEditCategory()
    {
        $this->viewEdit('categories','CategoryModel','category');
    }

    public function editCategory()
    {
        $data = $this->getOldEdit('categories','CategoryModel');
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $dt['categoryname'] = $_POST['categoryname'];
            $dt['activate'] = $_POST['activate'];
            date_default_timezone_set('Asia/BangKok');
            $dt['time_updated'] = date('y-m-d H:i:s');

            $this->edit('categories', 'CategoryModel', $dt);
            header('Location:' . HREFCATEGORY . '&page='.$_SESSION['page']);
        }
        $this->view('edit-category',$data);
    }
}
