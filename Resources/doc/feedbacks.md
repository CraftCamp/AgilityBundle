Feedbacks
========

The feedbacks are the thoughts and feelings of your users concerning your product.

They are the way to ensure user satisfaction, and the most precious resource a product owner has.

In later versions, the product owner will be able to choose a type and a priority for the feedbacks.

The developer field represents the feedback responsible.

The author field is the User who created the feedback.

The type is used to recognize if the object is a Feature or a Feedback.

Model
-----

The Feature object has the following fields :

* id (integer)
* type (string)
* name (string)
* slug (string)
* description (string)
* createdAt (DateTime)
* updatedAt (DateTime)
* status (integer)
* project (Developtech\AgilityBundle\Entity\Project)
* author (UserInterface)
* developer (UserInterface)

### Constants

#### status
STATUS_OPEN = 0;
STATUS_TO_DO = 1;
STATUS_IN_PROGRESS = 2;
STATUS_TO_VALIDATE = 3;
STATUS_DONE = 4;
STATUS_CLOSED = 5;

Services
--------

* [Get project feedbacks](#get-project-feedbacks)
* [Get project feedbacks by author](#get-project-feedbacks-by-author)
* [Get feedback](#get-feedback)
* [Create feedback](#create-feedback)
* [Count feedbacks per status](#count-feedbacks-per-status)

**Get project feedacks** <a name="get-project-feedbacks"></a>

This service returns all the feedbacks for a given project.

```php
$feedbacks = $this->get('developtech_agility.feedback_manager')->getProjectFeedbacks($project);
```

**Get project feedbacks by author** <a name="get-project-feedbacks-by-author"></a>

This service returns all the feedbacks for a given project created bythe given author.

It is also possible to use order by statements or paginate the results.

The arguments are :

* The project object
* The author. It must be an User object
* The order by array, the same used with the Doctrine ```findBy``` method
* The limit
* THe offset

```php
$feedbacks = $this->get('developtech_agility.feedback_manager')->getProjectFeedbacksByAuthor(
    $project,
    $author,
    [], // order by
    10, // limit
    50 // offset
);
```

**Get feature** <a name="get-feature"></a>

This service returns a feedback by its ID.

```php
$feature $this->get('developtech_agility.feedback_manager')->getFeedback($id);
```

**Create feedback** <a name="create-feedback"></a>

This service creates a new feedback for a given project.

The needed parameters are the following :

* The project object for this new feedback
* The name of the feedback
* The description
* The author. It must be an User object

This method will return the created Feedback object.

```php
$feedback = $this->get('developtech_agility.feedback_manager')->createFeedback(
    $project,
    'There is a bug in the kitchen',
    'The fridge is hotter than my computer !',
    $author // must be instance of UserInterface
);
```

**Count feedback per status** <a name="count-feedback-per-status"></a>

This service is meant to count the number of feedbacks for a given status.

The first parameter is the project object containing the feedbacks.

The second parameter is the feedback status you want to count. You should use the constants of the Feedback class for this purpose.

This method returns the counted feedbacks with the given status.

```php
$nbOpenedFeedbacks = $this->get('developtech_agility.feedback_manager')->countFeedbacksPerStatus($project, Feedback::STATUS_OPEN);
```
