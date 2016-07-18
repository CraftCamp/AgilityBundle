Feedbacks
========

Services
--------

* [Get project feedbacks](#get-project-feedbacks)
* [Get project feedbacks by author](#get-project-feedbacks-by-author)
* [Get feedback](#get-feedback)
* [Create feedback](#create-feedback)

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
