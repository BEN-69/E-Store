<?php
namespace MVC\Controllers;


use MVC\Lib\FileUpload;
use MVC\Lib\Helper;
use MVC\Lib\InputFilter;
use MVC\lib\Messenger;
use MVC\Models\ProductCategoryModel;
use MVC\Lib\Validate;


class ProductCategoriesController extends AbstractController
{

    use InputFilter;
    use Helper;
    use Validate;

    private $_createActionRoles =
        [
            'Name'          => 'req|alphanum|between(2,30)'
        ];

    public function defaultAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.default');

        $this->_data['categories'] = ProductCategoryModel::getAll();

        $this->_view();
    }

    public function createAction()
    {
        $this->language->load('template.common');
        $this->language->load('productcategories.create');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $uploadError=false;

        // TODO:: explain a better solution to check against file type
        // TODO:: explain a better soution to secure the upload folder
        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST) ) {
            $category = new ProductCategoryModel();
            $category->Name = $this->filterString($_POST['Name']);

            if(!empty($_FILES['Image']['name']) ) {

                // remove old Image
                if(!empty($category->Image) && file_exists(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image) && is_writable(CATEGORIES_IMAGES_UPLOAD_STORAGE)){

                    unlink(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image);
                }

                $upload = new FileUpload($_FILES['Image']);

                try {

                    $upload->upload(CATEGORIES_IMAGES_UPLOAD_STORAGE);

                    $category->Image = $upload->getFileName();

                } catch (\Exception $e){

                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);

                    $uploadError=true;
                }
            }


            if($uploadError === false && $category->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
                $this->redirect('/productcategories');
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

            $this->redirect('/productcategories');
        }

        $category = ProductCategoryModel::getByPK($id);

        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('template.common');
        $this->language->load('productcategories.edit');
        $this->language->load('productcategories.labels');
        $this->language->load('productcategories.messages');
        $this->language->load('validation.errors');

        $this->_data['productcategories'] = $category;

        $uploadError=false;

        if(isset($_POST['submit']) && $this->isValid($this->_createActionRoles, $_POST )) {

            $category->Name = $this->filterString($_POST['Name']);

            if(!empty($_FILES['Image']['name']) ) {

                // remove old Image
                if(!empty($category->Image) && file_exists(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image) && is_writable(CATEGORIES_IMAGES_UPLOAD_STORAGE)){

                    unlink(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image);
                }

                $upload = new FileUpload($_FILES['Image']);

                try {

                    $upload->upload(CATEGORIES_IMAGES_UPLOAD_STORAGE);

                    $category->Image = $upload->getFileName();

                } catch (\Exception $e){

                    $this->messenger->add($e->getMessage(), Messenger::APP_MESSAGE_ERROR);

                    $uploadError=true;
                }
            }
            if($uploadError === false && $category->save()) {
                $this->messenger->add($this->language->get('message_create_success'));
            } else {
                $this->messenger->add($this->language->get('message_create_failed'), Messenger::APP_MESSAGE_ERROR);
            }
            $this->redirect('/productcategories');
        }

        $this->_view();
    }
    // TODO corriger cette methode et pense supprimer aussi les produits de meme categorie
    public function deleteAction()
    {

        $id = $this->filterInt($this->_params[0]);
        $category = ProductCategoryModel::getByPK($id);


        if($category === false) {
            $this->redirect('/productcategories');
        }

        $this->language->load('productcategories.messages');

        $uploadError=false;


        if(!empty($category->Image) && file_exists(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image) && is_writable(CATEGORIES_IMAGES_UPLOAD_STORAGE )){

            unlink(CATEGORIES_IMAGES_UPLOAD_STORAGE.DS.$category->Image);

        }elseif(empty($category->Image)){
              $uploadError = false;
        }else{

            $this->messenger->add('Sorry the destination filder is not writable', Messenger::APP_MESSAGE_ERROR);
            $uploadError = true;

        }


        if($uploadError === false && $category->delete()) {
            $this->messenger->add($this->language->get('message_delete_success'));
        } else {
            $this->messenger->add($this->language->get('message_delete_failed'), Messenger::APP_MESSAGE_ERROR);
        }

        $this->redirect('/productcategories');
    }
}