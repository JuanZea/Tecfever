<?php

namespace App\Imports;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row['name'],
            'isEnabled' => $row['is_enabled'],
            'description' => $row['description'],
            'category' => $row['category'],
            'price' => $row['price'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:3|max:60',
            'description' => 'bail|required|min:10|max:1000',
            'category' => 'bail|required|in:computer,smartphone,accessory',
            'image' => 'bail|nullable|image',
            'is_enabled' => 'bail|required',
            'price' => 'bail|required|digits_between:4,9'
        ];
    }
}
