<?php

it("tests is an admin user can see the RH users page", function () {
    //Criar o admin:
    addAdminUser();

    //Efetuar login com o admin:
    auth()->loginUsingId(1);

    //Verifica se acede com sucesso à página de RH users:
    expect($this->get("/rh-users")->status())->toBe(200);
});

it("tests if is not possible to access the home page without logged user", function () {
    //Verificar se é possível aceder à home page:
    expect($this->get("/home")->status())->toBe(302);
    //Ou:
    expect($this->get("/home")->status())->not()->toBe(200);
});