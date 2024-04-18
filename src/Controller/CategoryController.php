<?php

namespace BasoMAlif\PerpustakaanDigitalUkk\Controller;
use BasoMAlif\PerpustakaanDigitalUkk\App\View;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\CategoryRepository;
use BasoMAlif\PerpustakaanDigitalUkk\Service\CategoryService;

class CategoryController 
{
    private CategoryService $categoryService;
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        $connection = Database::getConnection();
        $this->categoryRepository = new CategoryRepository($connection);
        $this->categoryService = new CategoryService($this->categoryRepository);
    }

    public function create()
    {
        View::render('Admin/tambahCategory', [
            'title' => 'Tambah Category | Perpustakaan Digital'
        ]);
    }

    public function postCreate()
    {
        $request = new CategoryCreateRequest();
        $request->name = $_POST['name'];

        try{
            $this->categoryService->create($request);
            View::redirect("/category");
        } catch (ValidationException $exception) {
            View::render('Admin/tambahCategory', [
                'title' => 'Tambah Category | Perpustakaan Digital',
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function findAll()
    {
        $categories = $this->categoryService->findAll();
        View::render('Admin/categories', [
            'title' => 'Daftar Category | Perpustakaan Digital',
            'categories' => $categories
        ]);
    }

    public function update(string $id)
    {   
        $categoryId = (int)$id;
        $category = $this->categoryRepository->findById($categoryId);

        View::render('Admin/updateCategory', [
            'title' => 'Update Category | Perpustakaan Digital',
            'category' => [
                'id' => $category->id,
                'name' => $category->name
                ]
        ]);
    }

    public function postUpdate(string $id)
    {
        $categoryId = (int) $id;
        $category = $this->categoryRepository->findById($categoryId);

        $request = new CategoryUpdateRequest();
        $request->id = $category->id;
        $request->name = $_POST['name'];

        try{
            $this->categoryService->update($request);
            View::redirect("/category");
        } catch (ValidationException $exception) {
            View::render('Admin/updateCategory', [
                'title' => 'Update Category | Perpustakaan Digital',
                'error' => $exception->getMessage(),
                'name' => $_POST['name']
            ]);
        }
    }

    public function delete(string $id)
    {
        $categoryId = (int)$id;
        $this->categoryService->delete($categoryId);
        View::redirect("/category");
    }
}