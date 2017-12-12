<?php
namespace MVC\Controllers;


use MVC\Lib\FileUpload;
use MVC\Lib\Helper;
use MVC\Lib\InputFilter;
use MVC\lib\Messenger;
use MVC\Models\ProductCategoryModel;
use MVC\Lib\Validate;
use MVC\Models\ProductModel;


class ProductListController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
        [
            'Name'              => 'req|alphanum|between(2,30)',
            'CategoryId'        => 'req|num',
            'Quantity'          => 'req|num',
            'BuyPrice'          => 'req|num|between(2,10)',
            'SellPrice'         => 'req|num|between(2,10)',
            'Unit'              => 'req|num'
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.default');

        $this->_data['products'] = ProductModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productlist.create');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');

        $uploadError=false;

        $this->_data['categories'] = ProductCategoryModel::getAll();


        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST) ) {
            $product = new ProductModel();
            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterInt($_POST['BuyPrice']);
            $product->SellPrice = $this->filterInt($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);


            if(!empty($_FILES['Image']['name']) ) {

                // remove old Image
                if(!empty($product->Image) && file_exists(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(PRODUCTS_IMAGES_UPLOAD_STORAGE)){

                    unlink(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image);
                }

                $upload = new FileUpload($_FILES['Image']);

                try {

                    $upload->upload(PRODUCTS_IMAGES_UPLOAD_STORAGE);

                    $product->Image = $upload->getFileName();

                } catch (\Exception $e){

                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);

                    $uploadError=true;
                }
            }


            if($uploadError === false && $product->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productlist');
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }

        }

        $this->_view();
    }

    public function editAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/productlist');
        }

        $product = ProductModel::getByPK($id);

        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->language->load('template.common');
        $this->language->load('productlist.edit');
        $this->language->load('productlist.labels');
        $this->language->load('productlist.messages');
        $this->language->load('productlist.units');
        $this->language->load('validation.errors');


        $this->_data['product']=$product;
        $this->_data['categories'] = ProductCategoryModel::getAll();

        $uploadError=false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST )) {

            $product->Name = $this->filterString($_POST['Name']);
            $product->CategoryId = $this->filterInt($_POST['CategoryId']);
            $product->Quantity = $this->filterInt($_POST['Quantity']);
            $product->BuyPrice = $this->filterFloat($_POST['BuyPrice']);
            $product->SellPrice = $this->filterFloat($_POST['SellPrice']);
            $product->Unit = $this->filterInt($_POST['Unit']);





            if(!empty($_FILES['Image']['name']) ) {

                // remove old Image
                if(!empty($product->Image) && file_exists(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(PRODUCTS_IMAGES_UPLOAD_STORAGE)){

                    unlink(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image);
                }

                $upload = new FileUpload($_FILES['Image']);

                try {

                    $upload->upload(PRODUCTS_IMAGES_UPLOAD_STORAGE);

                    $product->Image = $upload->getFileName();

                } catch (\Exception $e){

                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);

                    $uploadError=true;
                }
            }

            if($uploadError === false && $product->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }

            $this->redirect('/productlist');
        }

        $this->_view();
    }

    public function deleteAction()
    {

        if(isset($this->_params[0])){

            $id = $this->filterInt($this->_params[0]);

        }else{

            $this->redirect('/productlist');
        }
        $product = ProductModel::getByPK($id);


        if($product === false) {
            $this->redirect('/productlist');
        }

        $this->language->load('productlist.messages');

        $uploadError=false;


        if(!empty($product->Image) && file_exists(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image) && is_writable(PRODUCTS_IMAGES_UPLOAD_STORAGE )){

            unlink(PRODUCTS_IMAGES_UPLOAD_STORAGE.DS.$product->Image);

        }elseif(empty($product->Image)){
              $uploadError = false;
        }else{

            $this->messenger->add('Sorry the destination filder is not writable', Messenger::APP_MESSAGE_ERROR);
            $uploadError = true;

        }



        if($uploadError === false && $product->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }

        $this->redirect('/productlist');
    }
}