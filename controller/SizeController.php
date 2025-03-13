<?php

use Google\Service\AdExchangeBuyerII\Size;

require_once "model/SizeModel.php";
require_once "view/helpers.php";

class SizeController {
    private $sizeModel;

    public function __construct() {
        $this->sizeModel = new SizeModel();
    }

    public function index() {
        $sizes = $this->sizeModel->getAllSize();
        //compact: gom bien dien thanh array
        renderView("view/sizes/sizes_list.php", compact('sizes'), "sizes List");
    }

    public function show($id) {
        $sizes = $this->sizeModel->getSizeById($id);
        renderView("view/sizes/sizes_detail.php", compact('sizes'), "sizes Detail");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->sizeModel->createSize($name);
            header("Location: /sizes");
        } else {
            renderView("view/sizes/sizes_create.php", [], "Create sizes");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->sizeModel->updateSize($id, $name);
            header("Location: /sizes");
        } else {
            $sizes = $this->sizeModel->getSizeById($id);
            renderView("view/sizes/sizes_edit.php", compact('sizes'), "Edit sizes");
        }
    }

    public function delete($id) {
        $this->sizeModel->deletesize($id);
        header("Location: /sizes");
    }
}