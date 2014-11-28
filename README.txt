PHP_OOP
=======

== Description ==
This project is for learning purpose and improve my knowlege about OOP with PHP

== References ==
http://www.phpro.org/tutorials/Object-Oriented-Programming-with-PHP.html
http://www.tutorialspoint.com/php/php_object_oriented.htm
http://www.htmlgoodies.com/beyond/php/article.php/3909681

== The Task ==
You should implement classes to describe following entities and relations between them (you should implement only basic business logic):
User
    Has its own identifier
    Is able to do a payments using one of the payment methods which is bind to him.
Payment method
    Credit cards
    Bank transfer
    Each payment method has its own comission per transaction which is got from the amount of payment.
Payment has following properties:
    Payment amount
    Sum after comission is taken.
    Currency
    User
    Payment method
User can do following actions:
    Bind one or multiple payment methods (example - bind credit card to the user for further payments).
    Unbind payment method
    Make a payment, specifing payment method that should be used.
    Payments history - it should return the history of the payments of the user for all or selected payment method.
All the actions should be logged into log file. It should contain time of the action, name of the action and who did it (user).
There is NO need to use database. You should think about proper OOP structure of the task.
