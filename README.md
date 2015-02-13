# PTTest, Pharaoh Tools

## About:

Test Configuration and Execution Automation Management by Code in PHP. PTTest is for handling test suite
configuration and execution using a common set of rules across a range of tools and technologies. It can be used to
generate starter test suites for your applications, and automated test execution scripts within minutes.

By providing an common API by which to execute tests in a wide range of languages and test tools, you can run complex
test suites across a range of platforms with little to no extra configuration by convention, or you can write completely
customised automation scripts. Provision your tests manually or with an Operating System agnostic method of ensuring
environment stability.

PTTest is modular. object oriented and extendible, you can pretty easily write your own module if you want
functionality we haven't yet covered. Feel free to submit us pull requests.

This is part of the Pharaoh Tools suite, which covers Configuration Management, Test Automation Management, Automated
Deployment, Build and Release Management and more, all implemented in code, and all in PHP.

Its easy to write modules for any Operating System but we've begun with Ubuntu and adding more as soon as possible.
Currently, all of the Modules work on Ubuntu 12, most on 13, and a few on Centos.


## Installation

The preferred way to install any of the Pharaoh apps (including this) is through ptconfigure. If you install ptconfigure
on your machine (http://github.com/phpengine/ptconfigure), then you can install pttest using the following:

sudo ptconfigure pttest install --yes --guess

You can omit the --guess to pick your own installation directory. To install pttest cli on your machine
without ptconfigure, do the following. You'll need to already have php5 and git installed.

git clone https://github.com/phpengine/pttest && sudo php pttest/install-silent

or...

git clone https://github.com/phpengine/pttest && sudo php pttest/install (If you want to choose the install dir)

... that's it, now the pttest command should be available at the command line for you.


## Usage

So, there are a few simple commands...

First, you can just use

pttest

...This will give you a list of the available modules...


Then you can use

pttest *ModuleName* help

...This will display the help for that module, and tell you a list of available alias for the module command, and the
available actions too.

You'll be able to automate any action from any available module into an autopilot file, or run it from the CLI. I'm
working on a web front end, but you can also use JSON output and the PostInput module to use any module from an API.

Go to http://www.pharaoh-tools.org.uk for more


## Available Commands:

- Behat - Behat - Initialize or Execute a Behat Test Suite
- Cucumber - Cucumber - Initialize or Execute a Cucumber Test Suite
- EnvironmentConfig - Environment Configuration - Configure Environments for a project
- Generator - PTTest Autopilot Generator - Generate Autopilot files interactively
- PHPUnit - PHPUnit - Initialize or Execute a PHPUnit Test Suite
- SystemDetection - System Detection - Detect the Running Operating System
- Templating - Templating
- Testify - Testifyer - Creates default tests for your project