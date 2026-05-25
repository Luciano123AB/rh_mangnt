<?php

use App\Models\Department;

it("tests if an admin can insert a new RH user", function () {
    //Criar user admin:
    addAdminUser();

    //Criar os departamentos:
    addDepartment('Administração');
    addDepartment('Recursos Humanos');

    //Login com o admin:
    $result = $this->post("/login", [
        'email' => 'admin@rhmangnt.com',
        'password' => 'Aa123456'
    ]);

    //Verifica se o login foi feito com sucesso:
    expect($result->status())->toBe(302);
    expect($result->assertRedirect("/home"));

    //Verifica se o admin consegue adicionar user de rh:
    $result = $this->post("/rh-users/create-colaborator", [
        "name" => "Rh User 01",
        "email" => "rhuser@gmail.com",
        "select_department" => 2,
        "address" => "Rua 01",
        "zip_code" => "1234-123",
        "city" => "1234-City 1",
        "phone" => "123456789",
        "salary" => "1000.00",
        "admission_date" => "2021-01-10",
        "role" => "rh",
        "permissions" => '["rh"]'
    ]);

    //Verifica se o user rh foi inserido com sucesso:
    $this->assertDatabaseHas("users", [
        "name" => "Rh User 01",
        "email" => "rhuser@gmail.com",
        "role" => "rh",
        "permissions" => '["rh"]'
    ]);
});

function addDepartment($name) {
    Department::insert([
        'name' => $name,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
}