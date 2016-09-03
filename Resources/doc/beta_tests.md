Beta Tests
=========

Beta tests are the best way to receive feedbacks from your final users.

Whenever your application is ready, with the minimal set of features, you can organize beta tests.

Configuration options will be implemented in this bundle to allow strict or soft control of the feedbacks depending on the beta tests status.

Model
-----

* id (integer)
* name (string)
* slug (string)
* startedAt (DateTime)
* endedAt (DateTime)
* createdAt (DateTime)
* updatedAt (DateTime)
* betaTesters (Doctrine\Common\Collections\ArrayCollection)

Services
--------

* [Get by project](#get-by-project)

**Get by project** <a name="get-by-project"></a>

This service returns the list of the given project beta tests.

```php
$betaTests = $this->get('developtech_agility.beta_test_manager')->getByProject($project);
```
