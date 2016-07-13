Features
========

Services
--------

* [Get project features](#get-project-features)
* [Get feature](#get-feature)

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
