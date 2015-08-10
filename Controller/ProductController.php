<?php
require_once 'Model/ProductModel.php';
require_once 'Model/CategoryModel.php';
class ProductController extends BaseController
{
    public function index()
    {
        $model = new ProductModel('products');
        if(isset($_POST['activate']) || isset($_POST['delete'])){
            $this->handleBase('products','ProductModel');
        }
        if(isset($_GET['category_id'])){
            $category_id = $_GET['category_id'];
            $dt = $model->filter($category_id);
            $total_record = $dt->num_rows;
            $page = $_GET['page'];
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel(HREFPRODUCT.'&category_id='.$category_id.'&page=');
            $offset = $pagination->getOffset();
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
                $order = $_GET['order'];
                $data['data_limit'] = $model->filter_sort($category_id,$sort,$order,$offset,NUMBER_RECORD);
                $this->view('groupby-categories',$data);
            }
//            $data['data_limit'] = $model->filterLimit($category_id,$offset,NUMBER_RECORD);
//            $this->view('groupby-categories',$data);
            if(isset($_GET['search'])){
                $search = $_GET['search'];
                $dt = $model->filter_search($category_id,'productname',$search);
                $total_record = $dt->num_rows;
                $page = $_GET['page'];
                $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
                $data['link'] = $pagination->paginationPanel(HREFPRODUCT.'&category_id='.$category_id.'&page=');
                $offset = $pagination->getOffset();
                $data['data_limit'] = $model->filter_search_limit($category_id,'productname',$search,$offset,NUMBER_RECORD);
//                var_dump($data);
                $this->view('groupby-categories',$data);
            }
            $data['data_limit'] = $model->filterLimit($category_id,$offset,NUMBER_RECORD);
            $this->view('groupby-categories',$data);
        }
        else if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $dt = $model->joinsearch('productname',$search);
            $total_record = $dt->num_rows;
            $page = $_GET['page'];
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel(HREFPRODUCT.'&page=');
            $offset = $pagination->getOffset();
            $data['data_limit'] = $model->joinsearchLimit('productname',$search,$offset,NUMBER_RECORD);
            $this->view('list-products',$data);
        } else if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
            $order = $_GET['order'];
            $dt = $model->join();
            $total_record = $dt->num_rows;
            $page = $_GET['page'];
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel(HREFPRODUCT.'&page=');
            $offset = $pagination->getOffset();
            $data['data_limit'] = $model->joinsort($sort,$order,$offset,NUMBER_RECORD);
            $this->view('list-products',$data);
        }
        else {
//            if(isset($_POST['activate']) || isset($_POST['delete'])){
//                $this->handleBase('products','ProductModel');
//            }
            $dt = $model->join();
            $total_record = $dt->num_rows;
            $page = $_GET['page'];
            $pagination = new Pagination($total_record, NUMBER_RECORD, $page);
            $data['link'] = $pagination->paginationPanel(HREFPRODUCT.'&page=');
            $offset = $pagination->getOffset();
            $data['data_limit'] = $model->joinLimit($offset, NUMBER_RECORD);
            $this->view('list-products',$data);
        }
    }

    public function viewAddProduct()
    {
        $model = new CategoryModel('categories');
        $data = $model->getAll('*');
        $list  = array();
        while($row=$data->fetch_assoc()){
            $list[] = $row;
        }
        $this->view('add-product',['list' => $list]);
    }
    //controller add user
    public function addProduct()
    {
        if($_SERVER['REQUEST_METHOD']=='POST') {
            var_dump($_POST);
            $dt['productname'] = $_POST['productname'];
            $dt['price'] = $_POST['price'];
            $dt['description'] = $_POST['description'];
            $dt['activate'] = $_POST['activate'];
            $dt['image'] = $_POST['productname'];
            $dt['category_id'] = $_POST['category'];
            $this->add('products', 'ProductModel', $dt);
            $md = new ProductModel('products');
            $dt = $md->getAll('*');
            $totalRecord = $dt->num_rows;
            $totalPage = ceil($totalRecord / NUMBER_RECORD);
            header('Location:' . HREFPRODUCT . '&page=' . $totalPage);
        }
    }

    public function editProduct()
    {
        $data = $this->getOldEdit('products','ProductModel');
        $md = new CategoryModel('categories');
        $result = $md->getAll('id,categoryname');
        $list  = array();
        while($row=$result->fetch_assoc()) {
            $list[] = $row;
        }
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            var_dump($_POST);
            $dt['productname'] = $_POST['productname'];
            $dt['price'] = $_POST['price'];
            $dt['description'] = $_POST['description'];
            $dt['activate'] = $_POST['activate'];
            date_default_timezone_set('Asia/BangKok');
            $dt['time_updated'] = date('y-m-d H:i:s');
            $dt['image'] = $_POST['productname'];
            $dt['category_id'] = $_POST['category'];
            $this->edit('products', 'ProductModel', $dt);
            header('Location:' . HREFPRODUCT . '&page='.$_SESSION['page']);
        }
        $this->view('edit-product',['data'=>$data,'list'=>$list]);
    }
}
