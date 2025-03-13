<?php
require_once "model/ColorModel.php";
require_once "view/helpers.php";

class ColorController {
    private $colorModel;

    public function __construct() {
        $this->colorModel = new ColorModel();
    }

    public function index() {
        $colors = $this->colorModel->getAllColor();
        //compact: gom bien dien thanh array
        renderView("view/colors/colors_list.php", compact('colors'), "colors List");
    }

    public function show($id) {
        $colors = $this->colorModel->getColorById($id);
        renderView("view/colors/colors_detail.php", compact('colors'), "colors Detail");
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $this->colorModel->createColor($name);
            header("Location: /colors");
        } else {
            renderView("view/colors/colors_create.php", [], "Create colors");
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $this->colorModel->updateColor($id, $name);
            header("Location: /colors");
        } else {
            $colors = $this->colorModel->getColorById($id);
            renderView("view/colors/colors_edit.php", compact('colors'), "Edit colors");
        }
    }

    public function delete($id) {
        $this->colorModel->deletecolor($id);
        header("Location: /colors");
    }
}