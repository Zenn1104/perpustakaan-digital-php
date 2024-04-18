<?php 

namespace BasoMAlif\PerpustakaanDigitalUkk\Service;
use BasoMAlif\PerpustakaanDigitalUkk\Config\Database;
use BasoMAlif\PerpustakaanDigitalUkk\Domain\Category;
use BasoMAlif\PerpustakaanDigitalUkk\Exception\ValidationException;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryCreateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryCreateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryUpdateRequest;
use BasoMAlif\PerpustakaanDigitalUkk\Model\CategoryUpdateResponse;
use BasoMAlif\PerpustakaanDigitalUkk\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(CategoryCreateRequest $request) : CategoryCreateResponse
    {
        $this->ValidateCategoryCreateRequest($request);

        try{
            Database::beginTransaction();

            $category = new Category();
            $category->name = $request->name;

            $this->categoryRepository->save($category);

            $response = new CategoryCreateResponse();
            $response->category = $category;

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }

    }
    
    private function ValidateCategoryCreateRequest(CategoryCreateRequest $request)
    {
        if ($request->name == null || trim($request->name) == "") {
            throw new ValidationException("Category Name tidak boleh kosong!");
        }
    }

    public function findAll()
    {
        return $this->categoryRepository->findAll();
    }

    public function update(CategoryUpdateRequest $request) : CategoryUpdateResponse
    {
        $this->ValidateCategoryUpdateRequest($request);

        try{
            Database::beginTransaction();

            $category = $this->categoryRepository->findById($request->id);
            if ($category == null) {
                throw new ValidationException("Category tidak ditemukan.");
            }

            $category->name = $request->name;
            $this->categoryRepository->update($category);

            Database::commitTransaction();
            $response = new CategoryUpdateResponse();
            $response->category =$category;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function ValidateCategoryUpdateRequest(CategoryUpdateRequest $request) 
    {
        if ($request->name == null || trim($request->name) == "") {
            throw new ValidationException("Category Name tidak boleh kosong!");
        }
    }

    public function delete(string $id): void
    {
        $category = $this->categoryRepository->findById($id);
        if ($category == null){
            throw new ValidationException("category tidak ditemnukan");
        }
        $this->categoryRepository->delete($category->id);
    }
}