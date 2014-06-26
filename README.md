
# AyudarEsFacil 

> ayudaresfacil.org it's a platform that enables the community to make donations and offerings in an easy and intuitive way.


## Installation

### Platform & tools

You need to install apache ang mySql server. In windows you can install xampp.

You need to install Node.js and then the development tools. Node.js comes with a package manager called [npm](http://npmjs.org) for installing NodeJS applications and libraries.
* [Install node.js](http://nodejs.org/download/) (requires node.js version >= 0.8.4)
* Install Grunt-CLI and Karma as global npm modules:

    ```
    npm install -g grunt-cli karma bower
    ```

(Note that you may need to uninstall grunt 0.3 globally before installing grunt-cli)

### Get the Code

Either clone this repository or fork it on GitHub and clone your fork. You must download it to the **htdocs** folder of apache:

```
git clone https://github.com/seperez/ayudaresfacil.git
cd ayudaresfacil
```

### Data Base

You have to run the sql scripts to create the database and initialize. Do this in the order listed below:

	```
    /dbscripts/01 - ScriptBD_ayudaresfacil_createdb.sql
    /dbscripts/02 - ScriptBD_ayudaresfacil_georeferences.sql
    /dbscripts/03 - ScriptBD_ayudaresfacil.sql
    ```

### App Server

Our backend application server is developed with PHP Codeigniter.

### Client App

Our client application is a Angular application but our development process uses a Node.js build tool
[Grunt.js](gruntjs.com). Grunt relies upon some 3rd party libraries that we need to install as local dependencies using bower and npm.

* Install local dependencies (from the project root folder):

    ```
    cd client
    bower install
    npm install
    cd ..
    ```

  (This will install the dependencies declared in the client/bower.json and client/package.json files)

## Building

### Configure Server

Configure the database access (username and password)
```
api/application/config/database.php
```
## Running
### Start the Server
* Run the server
	
	Just start apache server and browse the application at [http://localhost/ayudaresfacil/api]
    
### Start the Client
* Run the client
	
	For run the client application you just got to do the following: 

    ```
    cd client
    grunt serve
    ```

## Running Client Test
### Unit Test

 	```
    cd client
    grunt watch
    cd ..
    ```

### Build the client app
The app made up of a number of javascript, css and html files that need to be merged into a final distribution for running (/build).  We use the Grunt default tool to do this.
* Build client application:

    ```
    cd client
    grunt 
    cd ..
    ```

*It is important to build again if you have changed the client configuration as above.*