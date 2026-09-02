<?php

test('admin panel bootstraps without crashing', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/admin/login');
});
