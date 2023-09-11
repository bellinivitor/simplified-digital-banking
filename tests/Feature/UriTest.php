<?php

use function Pest\Laravel\get;

test('Try access inexistent uri', function () {

    get('/api/v1/some-page-that-doesnt-exist')->assertNotFound();

})->group('Feature', 'Url');
