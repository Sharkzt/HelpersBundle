SharztHelpersBundle
===========

**SharztHelpersBundle** is a bundle, that extends symfony validator, html purifier classes for easy usage. It is easy to use, and
extensively unit tested!

[![Build Status](https://travis-ci.org/Sharkzt/HelpersBundle.svg?branch=master)]

Installation
------------

The recommended way to install Negotiation is through
[Composer](http://getcomposer.org/):

```bash
$ composer require sharkzt/helpersbundle
```


Usage Examples
--------------

### Validation

``` php

// Feel free to use as service like $validationHelper = $this->get('sharkzt_helpers.validation_helper');
$id = 111;
$email = "test@mail";
$validationHelper = new ValidationHelper(new ErrorHelper());
$validationHelper->setParameter([$id, $validationHelper->integer])
                 ->setParameter([$id, new Choice([1, 2, 3])])
                 ->setParameter([$email, new Email()]);
                 
if (!$validationHelper->validate()) {
    return $this->view($validationHelper->getResponse());
}
```

The `ValidationHelper` returns an array of errors if validation fails.

### Purification

``` php

//Set up your service $purifierHelper = $this->get('sharkzt_helpers.purifier_helper');
$purifierHelper = new PurifierHelper();
$purifier = $purifierHelper->initialize();
$xssCode = "<script>alert('Xss');</script>Hello world!"

//Purify your variable, to avoid any html code in
$pureString = $purifier->purify($xssCode);

```

The `$pureString` returns `Hello world!`.

License
-------

Negotiation is released under the MIT License. See the bundled LICENSE file for
details.
