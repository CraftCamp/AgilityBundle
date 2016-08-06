Features
========

The features are what your product will allow the user to do with it.

In an Agile project, a feature has to be valued by the Product Owner to sort features by priority.

The users are also able to vote and tell what importance has the feature for them.

In later versions, the user value will be handled with Vote objects, and the userValue field will be the average of the given values.

In later versions also, the team will be able to estimate the complexity of the feature development. It will allow priorization by a ratio between value and complexity.

The type is used to recognize if the object is a Feature or a Feedback.

The featureType field is used to know if the feature was created by the product owner or suggested by the users.

Model
-----

The Feature object has the following fields :

* id (integer)
* type (string)
* featureType (string)
* name (string)
* slug (string)
* description (string)
* productOwnerValue (integer)
* userValue (integer)
* createdAt (DateTime)
* updatedAt (DateTime)
* status (integer)
* project (Developtech\AgilityBundle\Entity\Project)
* responsible (UserInterface)

### Constants

#### featureType
FEATURE_TYPE_PRODUCT_OWNER = 'product-owner';
FEATURE_TYPE_USER = 'user';

#### status
STATUS_TO_SPECIFY = 0;
STATUS_TO_VALORIZE = 1;
STATUS_READY = 2;
STATUS_TO_DO = 3;
STATUS_IN_PROGRESS = 4;
STATUS_TO_VALIDATE = 5;
STATUS_TO_DEPLOY = 6;

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
```
