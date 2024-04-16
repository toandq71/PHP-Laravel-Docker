# PHP Checklist:


#### 1. Automatic check


<span style="color:green; font-weight:bold">&#9658; Must</span>
- [x] Use PHPMD to detect code smells and possible errors within the analyzed source code:
  - [x] Possible bugs.
  - [x] Suboptimal code.
  - [x] Overcomplicated expressions.
  - [x] Unused parameters, methods, properties.
- [x] Use PHPCS to check coding convention follow __PSR12__.


<span style="color:orange; font-weight:bold">&#9658; Should</span>
- [ ] Use PHP Intelephense extension for code completion, go to definition, declaration support.
- [ ] Use Prettier - Code formatter to format your code.


<span style="color:blue; font-weight:bold">&#9658; Tools & Techniques</span>
- Check convention with PHPCS: [(https://github.com/squizlabs/PHP_CodeSniffer)](https://github.com/squizlabs/PHP_CodeSniffer)
- Integrate with Github action: [(https://github.com/marketplace/actions/action-php-codesniffer)](https://github.com/marketplace/actions/action-php-codesniffer)
- Scan code by PHPMD: [(https://phpmd.org/](https://phpmd.org/) 
- Tool format code: [(https://github.com/prettier/plugin-php)](https://github.com/prettier/plugin-php)


#### 2. Readability & Simplicity

<span style="color:green; font-weight:bold">&#9658; Must</span>	

- [x] Naming convention
	- [ ] Class names MUST be declared in StudlyCaps.
	- [ ] Class constants MUST be declared in all uppercase with underscore separators.
	- [ ] Method names MUST be declared in camelCase.


- [x] Code format:
	- [ ] There MUST NOT be trailing whitespace at the end of lines.
	- [ ] The soft limit on line length MUST be __120 characters__.
	- [ ] Code MUST use an indent of 4 spaces for each indent level, and MUST NOT use tabs for indenting.


- [ ] There MUST NOT be more than one statement per line.
- [ ] Remove unused code (classes, variables, functions, ...). 
- [ ] Avoid initializing variables that are used only once, and do not comment out unused functions or variables.
- [ ] Do not abuse too many ternary operators.
- [ ] Any new types and keywords added to future PHP versions MUST be in lower case (null, true, false, int, string, array, etc).
- [ ] Short form of type keywords MUST be used i.e. bool instead of boolean, int instead of integer etc.
- [ ] For a complex handler function, don't process too much logic in one function, break it down into functions for each processing step and then invoke them.
- [ ] Constants must be placed in the right place, in their right object, for easy identification (except that shared constants like config or settings will be in places like config file, env file, … ). Let's create a method to check instead of checking the condition directly.


<span style="color:orange; font-weight:bold">&#9658; Should</span>
- [ ] YOU SHOULD NOT initialize a variable for one-time use (if you use it once, you should assign the value directly).
- [ ] Clearly define data types for variables, functions, parameters,... (version from 7.4 and later).
- [ ] A class should only handle its featured features, not too many unrelated features.
- [ ] Software entities (classes, modules, functions, etc.) should be open for extension, but closed for modification.
- [ ] Dependent classes can replace the parent class but still ensure correctness.
- [ ] Clients should not be forced to depend upon interfaces that they do not use.
- [ ] Should follow below principal when writing code:
  + KISS (Keep It Simple, Stupid): most systems work best if they are kept simple rather than made complex.
  + YAGNI (You Aren't Gonna Need It): don't implement something until it is necessary.


<span style="color:blue; font-weight:bold">&#9658; Tools & Techniques</span>
- [(https://github.com/webpro/programming-principles)](https://github.com/webpro/programming-principles)


#### 3. Maintainability, Scalability, Reusability

<span style="color:green; font-weight:bold">&#9658; Must</span>
- [ ] DO NOT pass by reference if not needed.
- [ ] DO NOT update migration file. If you want to modify column, table, … you MUST create a new migration file.
- [ ] DO NOT run command <span style="color:red; font-weight:bold">```php artisan migrate:fresh```</span> __on deploy server__ (staging, production, …).


<span style="color:orange; font-weight:bold">&#9658; Should</span>
- [ ] Avoid nesting too many clauses (if, loop, ...) no more than 3 levels.
- [ ] In Laravel use eloquent ORM instead of DB builder. Using an ORM will degrade performance, but this is negligible when implementing the application's features. It will make our code cleaner, easier to manage and maintain.


#### 4. Tests coverage

<span style="color:green; font-weight:bold">&#9658; Must</span>
- [ ] Run below command to generate coverage report:
    ```color
    __./vendor/bin/phpunit --coverage-html coverage__
- [ ] You MUST write unit test for functions which has __CRAP >= 5__.
- [ ] All unit tests must be passed.


<span style="color:orange; font-weight:bold">&#9658; Should</span>
- [ ] It's prefer 100% coverage, if can not reach 100% coverage, please make sure it's not lower than 50%.


#### 5. Performance & Security
<span style="color:green; font-weight:bold">&#9658; Must</span>

- [ ] Do not perform queries in a loop.
- [ ] Use __chunk()__ for processing large datasets to reduce memory usage.
- [ ] Ignore git .env file, do not push .env file to git.
- [ ] Eloquent and the Laravel query builder use prepared statements, which protect against SQL injection.
- [ ] Use Blade’s __{{ }}__ syntax which automatically escapes output to prevent XSS attacks.


<span style="color:orange; font-weight:bold">&#9658; Should</span>
- [ ] Use Laravel’s built-in rate limiting features to prevent abuse of your API endpoints.
- [ ] Handle time-consuming tasks like sending emails or processing images asynchronously with Laravel’s queue system.
- [ ] Use pagination to limit the amount of data sent to the client.


#### 6. Common rule
- [ ] KHÔNG public key lên code.
- [ ] KHÔNG log ENV ra console
- [ ] KHÔNG public tài liệu to everyone
- [ ] KHÔNG public DB, ko đặt user/pass common như: root/ password
- [ ] Do not store login account, ssh, pem file locally and easy to access, use Bitwarden instead (ex: [(https://bitwarden.com/)](https://bitwarden.com/))