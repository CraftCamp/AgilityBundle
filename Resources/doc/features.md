Features
========

Services
--------

* [Get project features](#get-project-features)
* [Get feature](#get-feature)
* [Create feature](#create-feature)

**Get project features** <a name="get-project-features"></a>

This service returns all the features for a given project.

```php
$features = $this->get('developtech_agility.feature_manager')->getProjectFeatures($project);
```

**Get feature** <a name="get-feature"></a>

This service returns a feature by its ID.

```php
$feature $this->get('developtech_agility.feature_manager')->getFeature($id);
```

**Create feature** <a name="create-feature"></a>

This service creates a new feature for a given project.

The needed parameters are the following :

* The project object for this new feature
* The name of the feature
* The description
* The feature status
* The product owner value (optional)
* The feature responsible. It must be an User object (optional)

This method will return the created Feature object.

```php
$feature = $this->get('developtech_agility.feature_manager')->createProductOwnerFeature(
    $project,
    'Todo list',
    'List of all the remainings actions to do',
    Feature::STATUS_TO_SPECIFY,
    80,
    $responsible // must be instance of UserInterface
);
