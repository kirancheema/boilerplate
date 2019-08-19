Creating a Simple Component for Joomla!4.x
==========================================

This is a multiple-article series of tutorials on how to develop a
Model-View-Controller [Component](S:MyLanguage/Component "wikilink") for
Joomla! Version 4x. You can navigate the articles in this series by
using the navigation drop down menu.

Begin with the Introduction, and navigate the articles in this series by
using the navigation button at the bottom or the box to the right
(*Articles in this series*). Let's start with the introduction.

Developing a Basic Component - Part 1
=====================================

Notes
-----

-   If you are new to Joomla!,

please read [Absolute Basics of How a Component
Functions](S:MyLanguage/Absolute_Basics_of_How_a_Component_Functions "wikilink").

-   This tutorial is for Joomlaǃ4.

For creating a component for Joomlaǃ3 see
\[<https://docs.joomla.org/J3.x:Developing_an_MVC_Component>| Developing
a Model-View-Controller Component/3.x\].

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev). You can download Joomla! 4 at
[GitHub](https://github.com/joomla/joomla-cms/tree/4.0-dev), on the
[Developer website](https://developer.joomla.org/nightly-builds.html) or
you can create a free website at <https://launch.joomla.org>.

Creating a simple Component/Developing a Basic Component
--------------------------------------------------------

You can see many examples of components in the standard Joomla! install.
For example

-   Content
-   Banners
-   Tags or
-   Contact

This tutorial will explain how to go about creating a simple component.
Through this tutorial you will learn the basic file structure of a
Joomlaǃ4 component. This basic structure can then be expanded to produce
more complex components.

### File Structure

There are a few basic files that are used in the standard pattern of
component development:

-   `administrator/components/com_foos/Controller/DisplayController.php` -
    This

file is Foos master display controller.

-   `administrator/components/com_foos/Extension/FoosComponent.php` -
    This

file is the Component class for com\_foos.

-   `administrator/components/com_foos/Service/HTML/AdministratorService.php` -
    This

file is the Content HTML helper.

-   `administrator/components/com_foos/View/Foos/HtmlView.php` - This

file is the View class for a list of foos.

-   `administrator/components/com_foos/services/provider.php` - This

file is the The foo service provider.

-   `administrator/components/com_foos/tmpl/foos/default.php` - This

file is the template for a list of foos.

-   `com_foo.xml` - This file contains information about the componente.

It defines the files that need to be installed by the Joomla! installer
and specifies configuration parameters for the componente.

-   `script.php` - This file is the Installation Script file of Foo
    Component.

### Creating administrator/components/com\_foos/Controller/DisplayController.php

The `administrator/components/com_foos/Controller/DisplayController.php`
file is is Foos master display controller.

#### Completed administrator/components/com\_foos/Controller/DisplayController.php file

The code for the
`administrator/components/com_foos/Controller/DisplayController.php`
file is as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * Foos master display controller.
 *
 * @since  1.0
 */
class DisplayController extends BaseController
{
    /**
     * The default view.
     *
     * @var    string
     * @since  1.0
     */
    protected $default_view = 'foos';

    /**
     * Method to display a view.
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
     *
     * @return  BaseController|bool  This object to support chaining.
     *
     * @since   1.0
     */
    public function display($cachable = false, $urlparams = array())
    {
        return parent::display();
    }
}
```

### Creating administrator/components/com\_foos/Extension/FoosComponent.php

The `administrator/components/com_foos/Extension/FoosComponent.php` file
is the Component class for com\_foos.

#### Completed administrator/components/com\_foos/Extension/FoosComponent.php file

The code for the
`administrator/components/com_foos/Extension/FoosComponent.php` file is
as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Joomla\Component\Foos\Administrator\Service\HTML\AdministratorService;

/**
 * Component class for com_foos
 *
 * @since  1.0.0
 */
class FoosComponent extends MVCComponent implements BootableExtensionInterface, CategoryServiceInterface
{
    use CategoryServiceTrait;
    use HTMLRegistryAwareTrait;

    /**
     * Booting the extension. This is the function to set up the environment of the extension like
     * registering new class loaders, etc.
     *
     * If required, some initial set up can be done from services of the container, eg.
     * registering HTML services.
     *
     * @param   ContainerInterface  $container  The container
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function boot(ContainerInterface $container)
    {
        $this->getRegistry()->register('foosadministrator', new AdministratorService);
    }
}
```

### Creating administrator/components/com\_foos/Service/HTML/AdministratorService.php

The
`administrator/components/com_foos/Service/HTML/AdministratorService.php`
file is ....

#### Completed administrator/components/com\_foos/Service/HTML/AdministratorService.php file

The code for the
`administrator/components/com_foos/Service/HTML/AdministratorService.php`
file is as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Service\HTML;

defined('JPATH_BASE') or die;

/**
 * Foo HTML class.
 *
 * @since  1.0
 */
class AdministratorService
{
}
```

### Creating administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Method to display the view.
     *
     * @param   string  $tpl  A template file to load. [optional]
     *
     * @return  mixed  A string if successful, otherwise an \Exception object.
     *
     * @since   1.0
     */
    public function display($tpl = null)
    {
        return parent::display($tpl);
    }
}
```

### Creating administrator/components/com\_foos/services/provider.php

The `administrator/components/com_foos/services/provider.php` file is
....

#### Completed administrator/components/com\_foos/services/provider.php file

The code for the
`administrator/components/com_foos/services/provider.php` file is as
follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Component\Foos\Administrator\Extension\FoosComponent;

/**
 * The foos service provider.
 * https://github.com/joomla/joomla-cms/pull/20217
 *
 * @since  1.0.0
 */
return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\Foos'));

        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new FoosComponent($container->get(ComponentDispatcherFactoryInterface::class));

                $component->setRegistry($container->get(Registry::class));

                return $component;
            }
        );
    }
};
```

### Creating administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}

Hello Foos
```

### Creating script.php

The `script.php` file is .... Most entries are self-explanatory.

#### Completed script.php file

The code for the `script.php` file is as follows:

``` {.php}

<?php

/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */
// No direct access to this file
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;

/**
 * Script file of Foo Component
 *
 * @since  1.0.0
 *
 */
class FoosInstallerScript
{
    /**
     * Extension script constructor.
     *
     * @since  1.0.0
     *
     */
    public function __construct()
    {
        $this->minimumJoomla = '4.0';
        $this->minimumPhp = JOOMLA_MINIMUM_PHP;
    }

    /**
     * Method to install the extension
     *
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     *
     * @since  1.0.0
     *
     */
    public function install($parent)
    {
        echo Text::_('COM_FOOS_INSTALLERSCRIPT_UNINSTALL');

        return true;
    }

    /**
     * Method to uninstall the extension
     *
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     *
     * @since  1.0.0
     *
     */
    public function uninstall($parent)
    {
        echo Text::_('COM_FOOS_INSTALLERSCRIPT_UNINSTALL');

        return true;
    }

    /**
     * Method to update the extension
     *
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     *
     * @since  1.0.0
     *
     */
    public function update($parent)
    {
        echo Text::_('COM_FOOS_INSTALLERSCRIPT_UPDATE');

        return true;
    }

    /**
     * Function called before extension installation/update/removal procedure commences
     *
     * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     *
     * @since  1.0.0
     *
     */
    public function preflight($type, $parent)
    {
        // Check for the minimum PHP version before continuing
        if (!empty($this->minimumPhp) && version_compare(PHP_VERSION, $this->minimumPhp, '<'))
        {
            Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_PHP', $this->minimumPhp), Log::WARNING, 'jerror');

            return false;
        }

        // Check for the minimum Joomla version before continuing
        if (!empty($this->minimumJoomla) && version_compare(JVERSION, $this->minimumJoomla, '<'))
        {
            Log::add(Text::sprintf('JLIB_INSTALLER_MINIMUM_JOOMLA', $this->minimumJoomla), Log::WARNING, 'jerror');

            return false;
        }

        echo Text::_('COM_FOOS_INSTALLERSCRIPT_PREFLIGHT');

        return true;
    }

    /**
     * Function called after extension installation/update/removal procedure commences
     *
     * @param   string            $type    The type of change (install, update or discover_install, not uninstall)
     * @param   InstallerAdapter  $parent  The class calling this method
     *
     * @return  boolean  True on success
     *
     * @since  1.0.0
     *
     */
    public function postflight($type, $parent)
    {
        echo Text::_('COM_FOOS_INSTALLERSCRIPT_POSTFLIGHT');

        return true;
    }
}
```

### Creating com\_foos.xml

The `foo.xml` file is .... Most entries are self-explanatory.

#### Completed foo.xml file

The code for the `foo.xml` file is as follows:

``` {.xml}

<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
        <scriptfile>script.php</scriptfile>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

Test your componente
--------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you can choose your component in the menu of the
Joomlaǃbackend.

![](as_j4_t_1_1.png "as_j4_t_1_1.png"){width="700"}

In the front end there is no change up to now. We are going to work on
this in the next chapter.

Note
----

### Version Number

If you ask yourself what version number you should take: Joomla strictly
follows Semantic Versioning (2.0.0) and it be good if you do this, too.
See
<https://developer.joomla.org/news/586-joomla-development-strategy.html#version_numbering>
and <https://semver.org/spec/v2.0.0.html> for more informations.

### index.html File

Why was there an index.html file in almost every folder in Joomla in the
past? The blank index.html file in each folder was to prevent directory
browsing via web address. On a poorly configured web server someone
could see all the files contained in a folder by simply browsing to the
path, such as www.example.org/images/. This could be a potential
security problem on servers without directory browsing (indexing) turned
off. Having the blank `index.html` file returns a blank white screen to
the browser rather than displaying the contents of the folder.

So, from a technical aspect, `index.html` files are not required on a
good configured web server, but do prevent directory access on badly
configured environments as already noted.

If you're looking to list an extension on the Joomla! Extensions
Directory, (JED) it is not required to have `index.html` files.

If you want to add `index.html` files to your site, you can copy the
script at
<https://github.com/joomla/joomla-cms/blob/staging/build/indexmaker.php>
and run it from a command line session on your server.

### Joomla! Extensions Directory

You can use the JEDChecker extension at
<http://extensions.joomla.org/extensions/miscellaneous/development/21336>
to check JED requirements.

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            new
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                new
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            new
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      new
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       new
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  new
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----

Conclusion
----------

Component development for Joomla! is a fairly simple, straightforward
process. Using the techniques described in this tutorial, an endless
variety of componentes can be developed with little hassle.

Boilerplates you can find hereː

-   <https://github.com/joomla-extensions/boilerplate/tree/master/plugins/system>

The sample files for this Tutorial you can find hereː

-   <https://github.com/astridx/boilerplate/tree/tutorial/tutorial/component/>

Adding a view to the site part - Part 2
=======================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>2.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

### Creating components/com\_foos/Controller/DisplayController.php

The `components/com_foos/Controller/DisplayController.php` file is the
main controller file for the frond end.

#### Completed components/com\_foos/Controller/DisplayController.php file

The code for the `components/com_foos/Controller/DisplayController.php`
file is as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

/**
 * Foos Component Controller
 *
 * @since  1.0
 */
class DisplayController extends BaseController
{
    /**
     * Constructor.
     *
     * @param   array                $config   An optional associative array of configuration settings.
     * Recognized key values include 'name', 'default_task', 'model_path', and
     * 'view_path' (this list is not meant to be comprehensive).
     * @param   MVCFactoryInterface  $factory  The factory.
     * @param   CMSApplication       $app      The JApplication for the dispatcher
     * @param   \JInput              $input    Input
     *
     * @since   1.0
     */
    public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
    {
        parent::__construct($config, $factory, $app, $input);
    }

    /**
     * Method to display a view.
     *
     * @param   boolean  $cachable   If true, the view output will be cached
     * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.
     *
     * @return  static  This object to support chaining.
     *
     * @since   1.0
     */
    public function display($cachable = false, $urlparams = array())
    {
        parent::display($cachable);

        return $this;
    }
}
```

### Creating components/com\_foos/View/Foo/HtmlView.php

The `components/com_foos/View/Foo/HtmlView.php` file is ....

#### Completed components/com\_foos/View/Foo/HtmlView.php file

The code for the `components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}

<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        return parent::display($tpl);
    }
}
```

### Creating components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is .... Most entries
are self-explanatory.

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}

Hallo
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you can see the view in the front end.

In the front end you can see the view if you open the address
joomla-cms4/index.php?option=com\_foos&view=foo.

![](as_j4_t_2_1.png "as_j4_t_2_1.png"){width="700"}

At the moment you have enter the address manually. It would be nicer to
have a menu item. We are going to work on this in the next chapter.

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            unchanged
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                new
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           new
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     new
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Now we have a basic view in the backend and in the front end.

Adding a menu type to the site part - Part 3
============================================

In this article we will cover how to add a menu item to a basic Joomla!
component.

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating components/com\_foos/tmpl/foo/default.xml

The `components/com_foos/tmpl/foo/default.xml` file is ....

#### Completed components/com\_foos/tmpl/foo/default.xml file

The code for the `components/com_foos/tmpl/foo/default.xml` file is as
follows:

``` {.xml}

<?xml version="1.0" encoding="utf-8"?>
<metadata>
    <layout title="COM_FOOS_FOO_VIEW_DEFAULT_TITLE">
        <message>
            <![CDATA[COM_FOOS_FOO_VIEW_DEFAULT_DESC]]>
        </message>
    </layout>
</metadata>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>3.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you can create a menu item in the menu manager.

![](as_j4_t_3_1.png "as_j4_t_3_1.png"){width="700"}

Save the menu item.

![](as_j4_t_3_2.png "as_j4_t_3_2.png"){width="700"}

Now you can see the view in the front using a menu item. In the front
end you can see the menu item and you can open the view with the help of
the menu item.

![](as_j4_t_3_3.png "as_j4_t_3_3.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            unchanged
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             new
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Now we are able to add a Menu Item to our component. This will allow us
to access our component a menu item rather than having to remember what
to type into the address bar. Currently the view does not show any data
yet. In order to work with data, we will add a model to our component in
the next chapter.

Adding a model to the site part - Part 4
========================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>4.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

### Creating components/com\_foos/Model/FooModel.php

The `components/com_foos/Model/FooModel.php` file is ....

#### Completed components/com\_foos/Model/FooModel.php file

The code for the `components/com_foos/Model/FooModel.php` file is as
follows:

``` {.php}

<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  1.0
 */
class FooModel extends BaseDatabaseModel
{
    /**
     * @var string message
     */
    protected $message;

    /**
     * Get the message
     *
     * @return  string  The message to be displayed to the user
     */
    public function getMsg()
    {
        if (!isset($this->message))
        {
            $this->message = 'Hello Foo!';
        }

        return $this->message;
    }
}
```

### Changing components/com\_foos/View/Foo/HtmlView.php

The `components/com_foos/View/Foo/HtmlView.php` file is ....

#### Completed components/com\_foos/View/Foo/HtmlView.php file

The code for the `components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->msg = $this->get('Msg');

        return parent::display($tpl);
    }
}
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is .... Most entries
are self-explanatory.

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php echo $this->msg;
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you can see the view in the front using a model.

![](as_j4_t_4_1.png "as_j4_t_4_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            unchanged
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     new
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           changed
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     changed
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

At the moment you can create a menu item, that shows a special view of
your component. What, if you want to show a view depending on a
parameter? That is easy. You can add a variable request in the menu
item. We are going to work on this in the next chapter.

Adding a variable request in the menu type - Part 5
===================================================

For the moment, the displayed message is always fix. In Joomla! it is
possible to add parameters to menu types.

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>5.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

### Changing components/com\_foos/Model/FooModel.php

The `components/com_foos/Model/FooModel.php` file is ....

#### Completed components/com\_foos/Model/FooModel.php file

The code for the `components/com_foos/Model/FooModel.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  1.0
 */
class FooModel extends BaseDatabaseModel
{
    /**
     * @var string message
     */
    protected $message;

    /**
     * Get the message
     *
     * @return  string  The message to be displayed to the user
     */
    public function getMsg()
    {
        $app = Factory::getApplication();
        $this->message = $app->input->get('show_text', "Hi");

        return $this->message;
    }
}
```

### Changing components/com\_foos/tmpl/foo/default.xml

The `components/com_foos/tmpl/foo/default.xml` file is ....

#### Completed components/com\_foos/tmpl/foo/default.xml file

The code for the `components/com_foos/tmpl/foo/default.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<metadata>
    <layout title="COM_FOOS_FOO_VIEW_DEFAULT_TITLE">
        <message>
            <![CDATA[COM_FOOS_FOO_VIEW_DEFAULT_DESC]]>
        </message>
    </layout>
    <!-- Add fields to the request variables for the layout. -->
    <fields name="request">
        <fieldset name="request">
            <field
                name="show_text"
                type="text"
                label="COM_FOOS_FIELD_TEXT_SHOW_LABEL"
                default="Hi" 
            />
        </fieldset>
    </fields>
</metadata>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.
A new installation of the extension is necessary.

After that you can add a parameter to the menu item. This parameter is
set in a text field.

![](as_j4_t_5_1.png "as_j4_t_5_1.png"){width="700"}

The text you entered in this text field is shown in the front end.
Depending on the parameter, the view is set up in the front end.

![](as_j4_t_5_2.png "as_j4_t_5_2.png"){width="700"}

Note
----

### Why do we omit the close tag?

Omitting the closing tag helps you prevent accidental whitespace or
newlines from being added to the end of the file. See:
<https://www.php.net/manual/en/language.basic-syntax.instruction-separation.php>

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            unchanged
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     changed
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             changed
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

For the moment, the parameter (messages) is hard coded or entered
manually. We would like to store this value in the Joomla database.
Therefore, in the next chapter, we will add database access to the
component.

Using the database in the backend - Part 6
==========================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(array('id', 'name'))
        );
        $query->from($db->quoteName('#__foos_details'));

        return $query;
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * Method to display the view.
     *
     * @param   string  $tpl  A template file to load. [optional]
     *
     * @return  mixed  A string if successful, otherwise an \Exception object.
     *
     * @since   1.0
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        return parent::display($tpl);
    }
}
```

### Changing administrator/components/com\_foos/services/provider.php

The `administrator/components/com_foos/services/provider.php` file is
....

#### Completed administrator/components/com\_foos/services/provider.php file

The code for the
`administrator/components/com_foos/services/provider.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Component\Foos\Administrator\Extension\FoosComponent;

/**
 * The foos service provider.
 * https://github.com/joomla/joomla-cms/pull/20217
 *
 * @since  1.0.0
 */
return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(new CategoryFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\Foos'));

        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new FoosComponent($container->get(ComponentDispatcherFactoryInterface::class));

                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));

                return $component;
            }
        );
    }
};
```

### Creating administrator/components/com\_foos/sql/install.mysql.utf8.sql

The `administrator/components/com_foos/sql/install.mysql.utf8.sql` file
is ....

#### Completed administrator/components/com\_foos/sql/install.mysql.utf8.sql file

The code for the
`administrator/components/com_foos/sql/install.mysql.utf8.sql` file is
as follows:

``` {.sql}

CREATE TABLE IF NOT EXISTS `#__foos_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

INSERT INTO `#__foos_details` (`name`) VALUES
('Nina'),
('Astrid'),
('Elmar');
```

### Creating administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql

The `administrator/components/com_foos/sql/uninstall.mysql.utf8.sql`
file is ....

#### Completed administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql file

The code for the
`administrator/components/com_foos/sql/uninstall.mysql.utf8.sql` file is
as follows:

``` {.sql}
DROP TABLE IF EXISTS `#__foos_details`;
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<?php foreach ($this->items as $i => $item) : ?>
<?php echo $item->name; ?>
</br>
<?php endforeach; ?>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>6.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>sql</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You have to run a new installation or fix the database due to the
changes in the database.

After that the data for this component is stored in the database.

In the next picture you can see how the data is retrieved and listed. In
the next chapters, we are working to make the data changeable in the
backend.

![](as_j4_t_6_1.png "as_j4_t_6_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Now our component has a database table where it can store data. In this
chapter we have seen, how we can display this data in the backend. In
the next chapter we will go on an check, how we can use the data in the
front end.

Using the database in the frontend - Part 7
===========================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating administrator/components/com\_foos/Controller/FooController.php

The `administrator/components/com_foos/Controller/FooController.php`
file is the controller file.

#### Completed administrator/components/com\_foos/Controller/FooController.php file

The code for the
`administrator/components/com_foos/Controller/FooController.php` file is
as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single foo
 *
 * @since  1.0
 */
class FooController extends FormController
{
}
```

### Creating administrator/components/com\_foos/Field/Modal/FooField.php

The `administrator/components/com_foos/Field/Modal/FooField.php` file is
contains the modal field.

#### Completed administrator/components/com\_foos/Field/Modal/FooField.php file

The code for the
`administrator/components/com_foos/Field/Modal/FooField.php` file is as
follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Field\Modal;

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

/**
 * Supports a modal foo picker.
 *
 * @since  1.0
 */
class FooField extends FormField
{
    /**
     * The form field type.
     *
     * @var     string
     * @since   1.0
     */
    protected $type = 'Modal_Foo';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   1.0
     */
    protected function getInput()
    {
        $allowClear  = ((string) $this->element['clear'] != 'false');
        $allowSelect = ((string) $this->element['select'] != 'false');

        // The active foo id field.
        $value = (int) $this->value > 0 ? (int) $this->value : '';

        // Create the modal id.
        $modalId = 'Foo_' . $this->id;

        // Add the modal field script to the document head.
        HTMLHelper::_('script', 'system/fields/modal-fields.min.js', array('version' => 'auto', 'relative' => true));

        // Script to proxy the select modal function to the modal-fields.js file.
        if ($allowSelect)
        {
            static $scriptSelect = null;

            if (is_null($scriptSelect))
            {
                $scriptSelect = array();
            }

            if (!isset($scriptSelect[$this->id]))
            {
                Factory::getDocument()->addScriptDeclaration("
                function jSelectFoo_" . $this->id . "(id, title, object) {
                    window.processModalSelect('Foo', '" . $this->id . "', id, title, '', object);
                }
                "
                );

                $scriptSelect[$this->id] = true;
            }
        }

        // Setup variables for display.
        $linkFoos = 'index.php?option=com_foos&amp;view=foos&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $linkFoo  = 'index.php?option=com_foos&amp;view=foo&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $modalTitle   = Text::_('COM_FOOS_CHANGE_FOO');

        $urlSelect = $linkFoos . '&amp;function=jSelectFoo_' . $this->id;

        if ($value)
        {
            $db    = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select($db->quoteName('name'))
                ->from($db->quoteName('#__foos_details'))
                ->where($db->quoteName('id') . ' = ' . (int) $value);
            $db->setQuery($query);

            try
            {
                $title = $db->loadResult();
            }
            catch (\RuntimeException $e)
            {
                Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
            }
        }

        $title = empty($title) ? Text::_('COM_FOOS_SELECT_A_FOO') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        // The current foo display field.
        $html  = '';

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '<span class="input-group">';
        }

        $html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" disabled="disabled" size="35">';

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '<span class="input-group-append">';
        }

        // Select foo button
        if ($allowSelect)
        {
            $html .= '<button'
                . ' class="btn btn-primary hasTooltip' . ($value ? ' hidden' : '') . '"'
                . ' id="' . $this->id . '_select"'
                . ' data-toggle="modal"'
                . ' type="button"'
                . ' data-target="#ModalSelect' . $modalId . '"'
                . ' title="' . HTMLHelper::tooltipText('COM_FOOS_CHANGE_FOO') . '">'
                . '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
                . '</button>';
        }

        // Clear foo button
        if ($allowClear)
        {
            $html .= '<button'
                . ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
                . ' id="' . $this->id . '_clear"'
                . ' type="button"'
                . ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
                . '<span class="icon-remove" aria-hidden="true"></span>' . Text::_('JCLEAR')
                . '</button>';
        }

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '</span></span>';
        }

        // Select foo modal
        if ($allowSelect)
        {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalSelect' . $modalId,
                array(
                    'title'       => $modalTitle,
                    'url'         => $urlSelect,
                    'height'      => '400px',
                    'width'       => '800px',
                    'bodyHeight'  => 70,
                    'modalWidth'  => 80,
                    'footer'      => '<a role="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">'
                                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>',
                )
            );
        }

        // Note: class='required' for client side validation.
        $class = $this->required ? ' class="required modal-value"' : '';

        $html .= '<input type="hidden" id="' . $this->id . '_id"' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
            . '" data-text="' . htmlspecialchars(Text::_('COM_FOOS_SELECT_A_FOO', true), ENT_COMPAT, 'UTF-8') . '" value="' . $value . '">';

        return $html;
    }

    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     *
     * @since   1.0
     */
    protected function getLabel()
    {
        return str_replace($this->id, $this->id . '_name', parent::getLabel());
    }
}
```

### Creating administrator/components/com\_foos/Model/FooModel.php

The `administrator/components/com_foos/Model/FooModel.php` file is the
model for a foo item.

#### Completed administrator/components/com\_foos/Model/FooModel.php file

The code for the `administrator/components/com_foos/Model/FooModel.php`
file is as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

/**
 * Item Model for a Foo.
 *
 * @since  1.0
 */
class FooModel extends AdminModel
{
    /**
     * The type alias for this content type.
     *
     * @var    string
     * @since  1.0
     */
    public $typeAlias = 'com_foos.foo';


    /**
     * Method to get the row form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  \JForm|boolean  A \JForm object on success, false on failure
     *
     * @since   1.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_foos.foo', 'foo', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.0
     */
    protected function loadFormData()
    {
        $app = Factory::getApplication();

        $data = $this->getItem();

        $this->preprocessData('com_foos.foo', $data);

        return $data;
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
```

### Creating administrator/components/com\_foos/Table/FooTable.php

The `administrator/components/com_foos/Table/FooTable.php` file is ....

#### Completed administrator/components/com\_foos/Table/FooTable.php file

The code for the `administrator/components/com_foos/Table/FooTable.php`
file is as follows:

``` {.php}

<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

/**
 * Foos Table class.
 *
 * @since  1.0
 */
class FooTable extends Table
{
    /**
     * Constructor
     *
     * @param   DatabaseDriver  $db  Database connector object
     *
     * @since   1.0
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_foos.foo';

        parent::__construct('#__foos_details', 'id', $db);
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>7.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Field</folder>
            <folder>Model</folder>
            <folder>Service</folder>
            <folder>Table</folder>
            <folder>View</folder>
            <folder>forms</folder>
            <folder>services</folder>
            <folder>sql</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

### Creating administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>

    <fieldset>

        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />
    </fieldset>


</form>
```

### Changing components/com\_foos/Model/FooModel.php

The `components/com_foos/Model/FooModel.php` file is ....

#### Completed components/com\_foos/Model/FooModel.php file

The code for the `components/com_foos/Model/FooModel.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  1.0
 */
class FooModel extends BaseDatabaseModel
{
    /**
     * @var string item
     */
    protected $_item = null;

    /**
     * Gets a foo
     *
     * @param   integer  $pk  Id for the foo
     *
     * @return  mixed Object or null
     *
     * @since   1.0
     */
    public function getItem($pk = null)
    {
        $app = Factory::getApplication();
        $pk = $app->input->getInt('id');

        if ($this->_item === null)
        {
            $this->_item = array();
        }

        if (!isset($this->_item[$pk]))
        {
            try
            {
                $db    = $this->getDbo();
                $query = $db->getQuery(true);

                $query->select('*')
                    ->from($db->quoteName('#__foos_details', 'a'))
                    ->where('a.id = ' . (int) $pk);

                $db->setQuery($query);
                $data = $db->loadObject();

                if (empty($data))
                {
                    throw new \Exception(Text::_('COM_FOOS_ERROR_FOO_NOT_FOUND'), 404);
                }

                $this->_item[$pk] = $data;
            }
            catch (\Exception $e)
            {
                $this->setError($e);
                $this->_item[$pk] = false;
            }
        }

        return $this->_item[$pk];
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {

        $this->items = $this->get('Items');

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        $toolbar->addNew('foo.add');
    }

}
```

### Changing components/com\_foos/View/Foo/HtmlView.php

The `components/com_foos/View/Foo/HtmlView.php` file is ....

#### Completed components/com\_foos/View/Foo/HtmlView.php file

The code for the `components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The item object details
     *
     * @var    \JObject
     * @since  1.0.0
     */
    protected $item;

    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        return parent::display($tpl);
    }
}
```

### Creating administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `components/com_foos/tmpl/foos/edit.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

$app = Factory::getApplication();
$input = $app->input;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <?php echo $this->getForm()->renderField('name'); ?>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Creating Creating administrator/components/com\_foos/tmpl/foo/modal.php

The `Creating administrator/components/com_foos/tmpl/foo/modal.php` file
is ....

#### Completed Creating administrator/components/com\_foo/tmpl/foos/modal.php file

The code for the `Creating components/com_foos/tmpl/foo/modal.php` file
is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="container-popup">
    <?php $this->setLayout('edit'); ?>
    <?php echo $this->loadTemplate(); ?>
</div>
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php 
echo $this->item->name;
```

### Creating administrator/components/com\_foos/tmpl/foos/modal.php

The `administrator/components/com_foos/tmpl/foos/modal.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foos/modal.php file

The code for the `administrator/components/com_foos/tmpl/foos/modal.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;

$app = Factory::getApplication();

HTMLHelper::_('script', 'com_foos/admin-foos-modal.min.js', array('version' => 'auto', 'relative' => true));

$function  = $app->input->getCmd('function', 'jSelectFoos');
$onclick   = $this->escape($function);
?>
<div class="container-popup">

    <form action="<?php echo Route::_('index.php?option=com_foos&view=foos&layout=modal&tmpl=component&function=' . $function . '&' . Session::getFormToken() . '=1'); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-warning">
                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                        </th>
                        <th scope="col" style="width:1%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $iconStates = array(
                    -2 => 'icon-trash',
                    0  => 'icon-unpublish',
                    1  => 'icon-publish',
                    2  => 'icon-archive',
                );
                ?>
                <?php foreach ($this->items as $i => $item) : ?>
                    <?php $lang = ''; ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <th scope="row">
                            <a class="select-link" href="javascript:void(0)" data-function="<?php echo $this->escape($onclick); ?>" data-id="<?php echo $item->id; ?>" data-title="<?php echo $this->escape($item->name); ?>">
                                <?php echo $this->escape($item->name); ?>
                            </a>
                        </th>
                        <td>
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

        <input type="hidden" name="task" value="">
        <input type="hidden" name="forcedLanguage" value="<?php echo $app->input->get('forcedLanguage', '', 'CMD'); ?>">
        <?php echo HTMLHelper::_('form.token'); ?>

    </form>
</div>
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php 
echo $this->item->name;
```

### Changing components/com\_foos/tmpl/foo/default.xml

The `components/com_foos/tmpl/foo/default.xml` file is ....

#### Completed components/com\_foos/tmpl/foo/default.xml file

The code for the `components/com_foos/tmpl/foo/default.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<metadata>
    <layout title="COM_FOOS_FOO_VIEW_DEFAULT_TITLE">
        <message>
            <![CDATA[COM_FOOS_FOO_VIEW_DEFAULT_DESC]]>
        </message>
    </layout>
    <!-- Add fields to the request variables for the layout. -->
    <fields name="request">
        <fieldset name="request"
            addfieldprefix="Joomla\Component\Foos\Administrator\Field"
        >
            <field
                name="id"
                type="modal_foo"
                label="COM_FOOS_SELECT_FOO_LABEL"
                required="true"
                select="true"
                new="true"
                edit="true"
                clear="true"
            />
        </fieldset>
    </fields>
</metadata>
```

### Creating media/com\_foos/js/admin-foos-modal.js

The `media/com_foos/js/admin-foos-modal.js` file is ....

#### Completed media/com\_foos/js/admin-foos-modal.js file

The code for the `media/com_foos/js/admin-foos-modal.js` file is as
follows:

``` {.js}
(function () {
  'use strict';
  /**
    * Javascript to insert the link
    * View element calls jSelectFoo when a foo is clicked
    * jSelectFoo creates the link tag, sends it to the editor,
    * and closes the select frame.
    */

  window.jSelectFoo = function (id, title, catid, object, link, lang) {
    var hreflang = '';

    if (!Joomla.getOptions('xtd-foos')) {
      // Something went wrong
      window.parent.Joomla.Modal.getCurrent().close();
      return false;
    }

    var _Joomla$getOptions = Joomla.getOptions('xtd-foos'),
        editor = _Joomla$getOptions.editor;

    if (lang !== '') {
      hreflang = "hreflang = \"".concat(lang, "\"");
    }

    var tag = "<a ".concat(hreflang, "  href=\"").concat(link, "\">").concat(title, "</a>");
    window.parent.Joomla.editors.instances[editor].replaceSelection(tag);
    window.parent.Joomla.Modal.getCurrent().close();
    return true;
  };

  document.addEventListener('DOMContentLoaded', function () {
    // Get the elements
    var elements = document.querySelectorAll('.select-link');

    for (var i = 0, l = elements.length; l > i; i += 1) {
      // Listen for click event
      elements[i].addEventListener('click', function (event) {
        event.preventDefault();
        var functionName = event.target.getAttribute('data-function');

        if (functionName === 'jSelectFoo') {
          // Used in xtd_foos
          window[functionName](event.target.getAttribute('data-id'), event.target.getAttribute('data-title'), null, null, event.target.getAttribute('data-uri'), event.target.getAttribute('data-language'), null);
        } else {
          // Used in com_menus
          window.parent[functionName](event.target.getAttribute('data-id'), event.target.getAttribute('data-title'), null, null, event.target.getAttribute('data-uri'), event.target.getAttribute('data-language'), null);
        }

        if (window.parent.Joomla.Modal) {
          window.parent.Joomla.Modal.getCurrent().close();
        }
      });
    }
  });
})();
```

Test your component
-------------------

This chapter contains a lot of work. It is the most extensive chapter in
this tutorial.

Now you can zip all files and install them via Joomla Extension Manager.
After that you

![](as_j4_t_7_1.png "as_j4_t_7_1.png"){width="700"}

![](as_j4_t_7_2.png "as_j4_t_7_2.png"){width="700"}

![](as_j4_t_7_3.png "as_j4_t_7_3.png"){width="700"}

![](as_j4_t_7_4.png "as_j4_t_7_4.png"){width="700"}

![](as_j4_t_7_5.png "as_j4_t_7_5.png"){width="700"}

![](as_j4_t_7_6.png "as_j4_t_7_6.png"){width="700"}

![](as_j4_t_7_7.png "as_j4_t_7_7.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7   administrator/components/com\_foos/Controller/FooController.php            this is the entry point to the Foo component                                                                                                                                          new
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7   administrator/components/com\_foos/Field/FooField.php                      the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   new
  7   administrator/components/com\_foos/Model/FooModel.php                      this is the model of the Foo component item                                                                                                                                           new
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7   administrator/components/com\_foos/Table/FooTable.php                      the database table                                                                                                                                                                    new
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7   administrator/components/com\_foos/forms/foo.xml                           the default form in the back end                                                                                                                                                      new
  7   administrator/components/com\_foos/tmpl/foo/edit.php                       the default view in the back end                                                                                                                                                      new
  7   administrator/components/com\_foos/tmpl/foo/modal.php                      the default view in the back end                                                                                                                                                      new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  7   administrator/components/com\_foos/tmpl/foos/modal.php                     the default view in the back end                                                                                                                                                      new
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     changed
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           changed
  7   components/com\_foos/View/Foos/HtmlView.php                                file representing the view in the frond end                                                                                                                                           new
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     changed
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             changed
  7   media/com\_foos/js/admin-foos-modal.js                                     the javascript file                                                                                                                                                                   new
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Using languages files - Part 8
==============================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>8.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.xml}
<?php defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

echo Text::_('COM_FOOS_NAME') . $this->item->name;
```

### Creating components/com\_foos/language/en-GB/en-GB.com\_foo.ini

The `components/com_foos/language/en-GB/en-GB.com_foo.ini` file is ....

#### Completed components/com\_foos/language/en-GB/en-GB.com\_foo.ini file

The code for the `components/com_foos/language/en-GB/en-GB.com_foo.ini`
file is as follows:

``` {.xml}

COM_FOOS_NAME="Name: "
```

### Creating administrator/components/com\_foos/language/en-GB/en-GB.com\_foo.ini

The `administrator/components/com_foos/language/en-GB/en-GB.com_foo.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foo.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foo.ini`
file is as follows:

``` {.xml}

COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"
```

### Creating administrator/components/com\_foos/language/en-GB/en-GB.com\_foo.sys.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foo.sys.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foo.sys.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foo.sys.ini`
file is as follows:

``` {.xml}

COM_FOOS="[PROJECT_NAME]"
COM_FOOS_XML_DESCRIPTION="Foo Component"

COM_FOOS_INSTALLERSCRIPT_PREFLIGHT="<p>Anything here happens before the installation/update/uninstallation of the component</p>"
COM_FOOS_INSTALLERSCRIPT_UPDATE="<p>The component has been updated</p>"
COM_FOOS_INSTALLERSCRIPT_UNINSTALL="<p>The component has been uninstalled</p>"
COM_FOOS_INSTALLERSCRIPT_INSTALL="<p>The component has been installed</p>"
COM_FOOS_INSTALLERSCRIPT_POSTFLIGHT="<p>Anything here happens after the installation/update/uninstallation of the component</p>"

COM_FOOS_FOO_VIEW_DEFAULT_TITLE="Single Foo"
COM_FOOS_FOO_VIEW_DEFAULT_DESC="This links to the information for one foo."
COM_FOOS_SELECT_FOO_LABEL="Select a foo"

COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that, all language strings are translated for all installed
languages.

![](as_j4_t_8_1.png "as_j4_t_8_1.png"){width="700"}

![](as_j4_t_8_2.png "as_j4_t_8_2.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7   administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7   administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7   administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7   administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1   administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7   administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8   administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     new
  8   administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     new
  2   components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7   components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     changed
  3   components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8   components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     new
  8   components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     new
  7   media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  --- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Adding configuration - Part 9
=============================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating administrator/components/com\_foos/config.php

The `administrator/components/com_foos/config.php` file is ....

#### Completed administrator/components/com\_foos/config.php file

The code for the `administrator/components/com_foos/config.php` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<config>

    <fieldset
        name="foo"
        label="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY"
        description="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC"
        >
        <field
            name="show_foo_name_label"
            type="list"
            label="COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>
    </fieldset>
</config>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>9.0.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.xml}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"
```

### Changing administrator/components/com\_foos/Model/FooModel.php

The `administrator/components/com_foos/Model/FooModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FooModel.php file

The code for the `administrator/components/com_foos/Model/FooModel.php`
file is as follows:

``` {.xml}
<?php
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {

        $this->items = $this->get('Items');

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        $toolbar->addNew('foo.add');
        $toolbar->preferences('com_foos');
    }

}
```

### Changing components/com\_foos/Model/FooModel.php

The `components/com_foos/Model/FooModel.php` file is ....

#### Completed components/com\_foos/Model/FooModel.php file

The code for the `components/com_foos/Model/FooModel.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

/**
 * Foo model for the Joomla Foos component.
 *
 * @since  1.0
 */
class FooModel extends BaseDatabaseModel
{
    /**
     * @var string item
     */
    protected $_item = null;

    /**
     * Gets a foo
     *
     * @param   integer  $pk  Id for the foo
     *
     * @return  mixed Object or null
     *
     * @since   1.0.0
     */
    public function getItem($pk = null)
    {
        $app = Factory::getApplication();
        $pk = $app->input->getInt('id');

        if ($this->_item === null)
        {
            $this->_item = array();
        }

        if (!isset($this->_item[$pk]))
        {
            try
            {
                $db    = $this->getDbo();
                $query = $db->getQuery(true);

                $query->select('*')
                    ->from($db->quoteName('#__foos_details', 'a'))
                    ->where('a.id = ' . (int) $pk);

                $db->setQuery($query);
                $data = $db->loadObject();

                if (empty($data))
                {
                    throw new \Exception(Text::_('COM_FOOS_ERROR_FOO_NOT_FOUND'), 404);
                }

                $this->_item[$pk] = $data;
            }
            catch (\Exception $e)
            {
                $this->setError($e);
                $this->_item[$pk] = false;
            }
        }

        return $this->_item[$pk];
    }
    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState()
    {
        $app = Factory::getApplication();

        $this->setState('foo.id', $app->input->getInt('id'));
        $this->setState('params', $app->getParams());
    }
}
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if ($this->get('State')->get('params')->get('show_foo_name_label')) {
    echo Text::_('COM_FOOS_NAME') . $this->item->name;
} else {
    echo $this->item->name;
}
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

Now you can globally use settings for your extension. You will find a
button in the top right corner of the backend where you can open the
options.

![](as_j4_t_9_1.png "as_j4_t_9_1.png"){width="700"}

The options are the configuration that you can use for all the items in
your extension.

![](as_j4_t_9_2.png "as_j4_t_9_2.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7   administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7   administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7   administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           changed
  6   administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7   administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7   administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7   administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1   administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1   administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8   administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     changed
  8   administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9   administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     new
  2   components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     changed
  2   components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7   components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     changed
  3   components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8   components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8   components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7   media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  --- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You can now use your component very flexibly. Maybe you like to offer
some settings only to a limited number of users. How to do this is the
topic of the next chapter.

Adding ACL - Part 10
====================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating administrator/components/com\_foos/access.xml

The `administrator/components/com_foos/access.xml` file is ....

#### Completed administrator/components/com\_foos/access.xml file

The code for the `administrator/components/com_foos/access.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<access component="com_foos">
    <section name="component">
        <action name="core.admin" title="JACTION_ADMIN" />
        <action name="core.options" title="JACTION_OPTIONS" />
        <action name="core.manage" title="JACTION_MANAGE" />
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
    </section>
</access>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.10.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>   
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(array('a.id', 'a.name', 'a.access'))
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        return $query;
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos');

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        if ($canDo->get('core.create'))
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.options'))
        {
            $toolbar->preferences('com_foos');
        }
    }
}
```

### Changing administrator/components/com\_foos/config.xml

The `administrator/components/com_foos/config.xml` file is ....

#### Completed administrator/components/com\_foos/config.xml file

The code for the `administrator/components/com_foos/config.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<config>

    <fieldset
        name="foo"
        label="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY"
        description="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC"
        >

        <field
            name="show_foo_name_label"
            type="list"
            label="COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>

    </fieldset>
    <fieldset
        name="permissions"
        label="JCONFIG_PERMISSIONS_LABEL"
        description="JCONFIG_PERMISSIONS_DESC"
        >

        <field
            name="rules"
            type="rules"
            label="JCONFIG_PERMISSIONS_LABEL"
            validate="rules"
            filter="rules"
            component="com_foos"
            section="component"
        />

    </fieldset>
</config>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset>
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Creating administrator/components/com\_foos/sql/updates/mysql/1.10.0.sql

The `administrator/components/com_foos/sql/updates/mysql/1.10.0.sql`
file is ....

#### Completed administrator/components/com\_foos/sql/updates/mysql/1.10.0.sql file

The code for the
`administrator/components/com_foos/sql/updates/mysql/1.10.0.sql` file is
as follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `access` int(10) unsigned NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__foos_details` ADD KEY `idx_access` (`access`);
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

$app = Factory::getApplication();
$input = $app->input;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <?php echo $this->getForm()->renderField('name'); ?>
    <?php echo $this->getForm()->renderField('access'); ?>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foo/default.php

The `administrator/components/com_foos/tmpl/foo/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foo/default.php file

The code for the
`administrator/components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.xml}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-10">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
                                </th>
                                <th scope="col">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?></a>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

Note
----

In this tutorial we only cover MySql. How to handle postgrep you can
find in the file joomla-cms4/administrator/manifests/files/joomla.xml

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You have to run a new installation or fix the database due to the
changes in the database.

Now you can set the permissions for the component in the configuration
(options).

![](as_j4_t_10_1.png "as_j4_t_10_1.png"){width="700"}

In the overview in the backend you can see a new table column. This is a
value entered if a specific authorization has been set for an item.

![](as_j4_t_10_2.png "as_j4_t_10_2.png"){width="700"}

You can specify a special permission when editing a item. You can see
that in the next picture.

![](as_j4_t_10_3.png "as_j4_t_10_3.png"){width="700"}

Example in Joomla!
------------------

Note
----

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ---- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1    administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7    administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1    administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7    administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7    administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6    administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                changed
  1    administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7    administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1    administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            changed
  1    administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6    administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           changed
  6    administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7    administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      changed
  7    administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      changed
  7    administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1    administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      changed
  7    administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1    administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1    administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8    administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8    administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9    administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     changed
  10   administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   new
  2    components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4    components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2    components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7    components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2    components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3    components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8    components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8    components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7    media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  ---- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You can now accomplish many things with your component. It is very
important, however, to make the component user-friendly. The next two
chapters deal with validation for this reason.

Adding Server side validation - Part 11a
========================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Create administrator/components/com\_foos/Rule/LetterRule.php

The `administrator/components/com_foos/Rule/LetterRule.php` file is ....

#### Completed administrator/components/com\_foos/Rule/LetterRule.php file

The code for the `administrator/components/com_foos/Rule/LetterRule.php`
file is as follows:

``` {.php}
<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Rule;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Form\FormRule;

/**
 * Form Rule class for the Joomla Platform.
 *
 * @since  1.7.0
 */
class LetterRule extends FormRule
{
    /**
     * The regular expression to use in testing a form field value.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $regex = '^([a-z]+)$';

    /**
     * The regular expression modifiers to use when testing a form field value.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $modifiers = 'i';
}
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset addruleprefix="Joomla\Component\Foos\Administrator\Rule">
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Changing administrator/components/com\_foos/foo.xml

The `administrator/components/com_foos/foo.xml` file is ....

#### Completed administrator/components/com\_foos/foo.xml file

The code for the `administrator/components/com_foos/foo.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.11.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you can

Example in Joomla!
------------------

If you want to save a letter in the name, this is not possible. You will
now see an error message after clicking the Save button

![](as_j4_t_11a_1.png "as_j4_t_11a_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      changed
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       new
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

It is no longer possible to save an invalid value. In large forms, it is
not user-friendly to display all errors at the very end. Therefore,
server-side validation is often supplemented with client-side
validation, which checks during input. You can read more on this topic
in the next chapter.

Adding Client side validation - Part 11b
========================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foo.xml

The `administrator/components/com_foos/foo.xml` file is ....

#### Completed administrator/components/com\_foos/foo.xml file

The code for the `administrator/components/com_foos/foo.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.11.1</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Create media/com\_foos/js/admin-foos-letter.js

The `media/com_foos/js/admin-foos-letter.js` file is ....

#### Completed media/com\_foos/js/admin-foos-letter.js file

The code for the `media/com_foos/js/admin-foos-letter.js` file is as
follows:

``` {.js}
document.addEventListener('DOMContentLoaded', function(){
    "use strict";
    if (document.formvalidator) {
        document.formvalidator.setHandler('letter', function (value) {

            var returnedValue = false;

            var regex = /^([a-z]+)$/i;

            if (regex.test(value))
                returnedValue = true;

            return returnedValue;
        });
        //console.log(document.formvalidator);
    } 
});
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset addruleprefix="Joomla\Component\Foos\Administrator\Rule">
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <?php echo $this->getForm()->renderField('name'); ?>
    <?php echo $this->getForm()->renderField('access'); ?>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

If you now enter a number in the name field, you will see an error
message immediately after leaving the field. For server-side validation,
you only saw the error message after you submitted the form to the
server using the Save button.

![](as_j4_t_11b_1.png.png "as_j4_t_11b_1.png.png"){width="700"}

Example in Joomla
-----------------

/media/system/js/fields/passwordstrength.js
/administrator/components/com\_users/forms/user.xml

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      changed
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       new
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You now know the validation very well. Next, we'll look at how you can
create categories and easily map your items.

Adding categories - Part 12
===========================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(array('a.id', 'a.name', 'a.catid', 'a.access'))
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        return $query;
    }
}
```

### Changing administrator/components/com\_foos/access.xml

The `administrator/components/com_foos/access.xml` file is ....

#### Completed administrator/components/com\_foos/access.xml file

The code for the `administrator/components/com_foos/access.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<access component="com_foos">
    <section name="component">
        <action name="core.admin" title="JACTION_ADMIN" />
        <action name="core.options" title="JACTION_OPTIONS" />
        <action name="core.manage" title="JACTION_MANAGE" />
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
    </section>
    <section name="category">
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
    </section>
</access>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?php
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset addruleprefix="Joomla\Component\Foos\Administrator\Rule">
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Changing administrator/components/com\_foos/sql/update/1.12.0.sql

We will implement `state` later.

The `administrator/components/com_foos/sql/update/1.12.0.sql` file is
....

#### Completed administrator/components/com\_foos/sql/update/1.12.0.sql file

The code for the
`administrator/components/com_foos/sql/update/1.12.0.sql` file is as
follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `catid` int(11) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__foos_details` ADD COLUMN  `state` tinyint(3) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__foos_details` ADD KEY `idx_catid` (`catid`);
```

### Changing administrator/components/com\_foos/Extension/FoosComponent.php

The `administrator/components/com_foos/Extension/FoosComponent.php` file
is ....

#### Completed administrator/components/com\_foos/Extension/FoosComponent.php file

The code for the
`administrator/components/com_foos/Extension/FoosComponent.php` file is
as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Joomla\Component\Foos\Administrator\Service\HTML\AdministratorService;

/**
 * Component class for com_foos
 *
 * @since  1.0.0
 */
class FoosComponent extends MVCComponent implements BootableExtensionInterface, CategoryServiceInterface
{
    use CategoryServiceTrait;
    use HTMLRegistryAwareTrait;

    /**
     * Booting the extension. This is the function to set up the environment of the extension like
     * registering new class loaders, etc.
     *
     * If required, some initial set up can be done from services of the container, eg.
     * registering HTML services.
     *
     * @param   ContainerInterface  $container  The container
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function boot(ContainerInterface $container)
    {
        $this->getRegistry()->register('foosadministrator', new AdministratorService);
    }

    /**
     * Returns the table for the count items functions for the given section.
     *
     * @param   string  $section  The section
     *
     * @return  string|null
     *
     * @since   1.0.0
     */
    protected function getTableNameForSection(string $section = null)
    {
        return ($section === 'category' ? 'categories' : 'foos_details');
        
    }
}
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <?php echo $this->getForm()->renderField('name'); ?>
    <?php echo $this->getForm()->renderField('access'); ?>
    <?php echo $this->getForm()->renderField('catid'); ?>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-10">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
                                </th>
                                <th scope="col">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You have to run a new installation or fix the database due to the
changes in the database.

After that you can

It would be good, to set a default categorie while installing your
component. You can do this in the file `script.php`

Example in Joomla!
------------------

In the sidebar you now see another menu item. With this menu item you
can create categories for your extension.

![](as_j4_t_12b_1.png "as_j4_t_12b_1.png"){width="700"}

You can select this category when editing an item.

![](as_j4_t_12b_2.png "as_j4_t_12b_2.png"){width="700"}

If a category is assigned, it will be displayed in the overview.

![](as_j4_t_12b_3.png "as_j4_t_12b_3.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   changed
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You can now classify the items into categories. Next, we'll look at how
to change the state of an item.

Adding Published/Unpublished - Part 13
======================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Creating administrator/components/com\_foos/Controller/FoosController.php

The `administrator/components/com_foos/Controller/FoosController.php`
file is ....

#### Completed administrator/components/com\_foos/Controller/FoosController.php file

The code for the
`administrator/components/com_foos/Controller/FoosController.php` file
is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\Application\CmsApplication;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

/**
 * Contacts list controller class.
 *
 * @since  1.0
 */
class FoosController extends AdminController
{
    /**
     * The prefix to use with controller messages.
     *
     * @var    string
     * @since  1.0
     */
    protected $text_prefix = 'COM_FOOS_FOOS';

    /**
     * Constructor.
     *
     * @param   array                $config   An optional associative array of configuration settings.
     * Recognized key values include 'name', 'default_task', 'model_path', and
     * 'view_path' (this list is not meant to be comprehensive).
     * @param   MVCFactoryInterface  $factory  The factory.
     * @param   CMSApplication       $app      The JApplication for the dispatcher
     * @param   \JInput              $input    Input
     *
     * @since   1.0
     */
    public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
    {
        parent::__construct($config, $factory, $app, $input);

    }

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The name of the model.
     * @param   string  $prefix  The prefix for the PHP class name.
     * @param   array   $config  Array of configuration parameters.
     *
     * @return  \Joomla\CMS\MVC\Model\BaseDatabaseModel
     *
     * @since   1.0
     */
    public function getModel($name = 'Foo', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}
```

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(
                explode(
                    ', ',
                    $this->getState(
                        'list.select',
                        'a.id, a.name, a.catid' .
                        ', a.access' .
                        ', a.published' .
                        ', a.publish_up, a.publish_down'
                    )
                )
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        return $query;
    }
}
```

### Changing administrator/components/com\_foos/Table/FooTable.php

The `administrator/components/com_foos/Table/FooTable.php` file is ....

#### Completed administrator/components/com\_foos/Table/FooTable.php file

The code for the `administrator/components/com_foos/Table/FooTable.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

/**
 * Foos Table class.
 *
 * @since  1.0
 */
class FooTable extends Table
{
    /**
     * Constructor
     *
     * @param   DatabaseDriver  $db  Database connector object
     *
     * @since   1.0
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_foos.foo';

        parent::__construct('#__foos_details', 'id', $db);

         
    }

    /**
     * Overloaded check function
     *
     * @return  boolean
     *
     * @see     Table::check
     * @since   1.5
     */
    public function check()
    {
        try
        {
            parent::check();
        }
        catch (\Exception $e)
        {
            $this->setError($e->getMessage());

            return false;
        }

        // Set name
        $this->name = htmlspecialchars_decode($this->name, ENT_QUOTES);

        // Check the publish down date is not earlier than publish up.
        if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up)
        {
            $this->setError(Text::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));

            return false;
        }

        if (empty($this->publish_up))
        {
            $this->publish_up = $this->getDbo()->getNullDate();
        }

        if (empty($this->publish_down))
        {
            $this->publish_down = $this->getDbo()->getNullDate();
        }

        return true;
    }
}
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset addruleprefix="Joomla\Component\Foos\Administrator\Rule">
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
            >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file translation file. In this part you can learn how to use this with
plural.

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.ini}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."
```

### Create administrator/components/com\_foos/sql/updates/1.13.0.sql

The `administrator/components/com_foos/sql/updates/1.13.0.sql` file is
....

#### Completed administrator/components/com\_foos/sql/updates/1.13.0.sql file

The code for the
`administrator/components/com_foos/sql/updates/1.13.0.sql` file is as
follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `published` tinyint(1) NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__foos_details` ADD COLUMN  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `alias`;

ALTER TABLE `#__foos_details` ADD COLUMN  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `alias`;

ALTER TABLE `#__foos_details` ADD KEY `idx_state` (`published`);
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <?php echo $this->getForm()->renderField('name'); ?>
    <?php echo $this->getForm()->renderField('access'); ?>
    <?php echo $this->getForm()->renderField('published'); ?>
    <?php echo $this->getForm()->renderField('publish_up'); ?>
    <?php echo $this->getForm()->renderField('publish_down'); ?>
    <?php echo $this->getForm()->renderField('catid'); ?>
    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$canChange  = true;
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-10">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
                                </th>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo Text::_('JSTATUS'); ?>
                                </th>
                                <th scope="col">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You have to run a new installation or fix the database due to the
changes in the database.

After that you can

Example in Joomla!
------------------

If you edit an item, you can now also specify the period to which it
should be published.

![](as_j4_t_13_1.png "as_j4_t_13_1.png"){width="700"}

In the overview you can see if an item is published or not. If you click
the symbol the state is changed.

![](as_j4_t_13_1.png "as_j4_t_13_1.png"){width="700"}

In category manager, the items are now also displayed with the correct
state.

![](as_j4_t_13_1.png "as_j4_t_13_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Now you can schedule the publication of your items. Now we continue with
custom fields

Adding Custom Fields in the backend - Part 14a
==============================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.xml}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        FooHelper::addSubmenu('foos');
        $this->sidebar = \JHtmlSidebar::render();

        $canDo = ContentHelper::getActions('com_foos');

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        if ($canDo->get('core.create'))
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.options'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }
}
```

### Changing administrator/components/com\_foos/access.xml

The `administrator/components/com_foos/access.xml` file is ....

#### Completed administrator/components/com\_foos/access.xml file

The code for the `administrator/components/com_foos/access.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<access component="com_foos">
    <section name="component">
        <action name="core.admin" title="JACTION_ADMIN" />
        <action name="core.options" title="JACTION_OPTIONS" />
        <action name="core.manage" title="JACTION_MANAGE" />
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
        <action name="core.edit.value" title="JACTION_EDITVALUE" />
    </section>
    <section name="category">
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
    </section>
    <section name="fieldgroup">
        <action name="core.create" title="JACTION_CREATE" />
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.own" title="JACTION_EDITOWN" />
        <action name="core.edit.value" title="JACTION_EDITVALUE" />
    </section>
    <section name="field">
        <action name="core.delete" title="JACTION_DELETE" />
        <action name="core.edit" title="JACTION_EDIT" />
        <action name="core.edit.state" title="JACTION_EDITSTATE" />
        <action name="core.edit.value" title="JACTION_EDITVALUE" />
    </section>
</access>
```

### Changing administrator/components/com\_foos/config.xml

The `administrator/components/com_foos/config.xml` file is ....

#### Completed administrator/components/com\_foos/config.xml file

The code for the `administrator/components/com_foos/config.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<config>

    <fieldset
        name="foo"
        label="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY"
        description="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC"
        >

        <field
            name="show_foo_name_label"
            type="list"
            label="COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>

        <field
            name="custom_fields_enable"
            type="radio"
            class="switcher"
            label="JGLOBAL_CUSTOM_FIELDS_ENABLE_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>

    </fieldset>
    <fieldset
        name="permissions"
        label="JCONFIG_PERMISSIONS_LABEL"
        description="JCONFIG_PERMISSIONS_DESC"
        >

        <field
            name="rules"
            type="rules"
            label="JCONFIG_PERMISSIONS_LABEL"
            validate="rules"
            filter="rules"
            component="com_foos"
            section="component"
        />

    </fieldset>
</config>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.14.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.xml}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_EDIT_FOO="Edit Foo"
COM_FOOS_NEW_FOO="New Foo"
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

$this->useCoreUI = true;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <div>
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', empty($this->item->id) ? Text::_('COM_FOOS_NEW_FOO') : Text::_('COM_FOOS_EDIT_FOO')); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">

    <?php echo $this->getForm()->renderField('name'); ?>
    <?php echo $this->getForm()->renderField('access'); ?>
    <?php echo $this->getForm()->renderField('published'); ?>
    <?php echo $this->getForm()->renderField('publish_up'); ?>
    <?php echo $this->getForm()->renderField('publish_down'); ?>
    <?php echo $this->getForm()->renderField('catid'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>
        
        <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

        <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    </div>

        <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.xml}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$canChange  = true;
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
                                </th>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo Text::_('JSTATUS'); ?>
                                </th>
                                <th scope="col">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

### Creating administrator/components/com\_foos/Helper

The `administrator/components/com_foos/Helper` file is ....

#### Completed administrator/components/com\_foos/Helper file

The code for the `administrator/components/com_foos/Helper` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;

/**
 * Foo component helper.
 *
 * @since  1.0
 */
class FooHelper extends ContentHelper
{
    /**
     * Configure the Linkbar.
     *
     * @param   string  $vName  The name of the active view.
     *
     * @return  void
     *
     * @since   1.0
     */
    public static function addSubmenu($vName)
    {
        if (ComponentHelper::isEnabled('com_fields') && ComponentHelper::getParams('com_foos')->get('custom_fields_enable', '1'))
        {
            \JHtmlSidebar::addEntry(
                Text::_('JGLOBAL_FIELDS'),
                'index.php?option=com_fields&context=com_foos.foo',
                $vName == 'fields.fields'
            );
            \JHtmlSidebar::addEntry(
                Text::_('JGLOBAL_FIELD_GROUPS'),
                'index.php?option=com_fields&view=groups&context=com_foos.foo',
                $vName == 'fields.groups'
            );
        }
    }
}
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

After that you have an option for activating custom fields in the
options of your component.

![](as_j4_t_14_1.png "as_j4_t_14_1.png"){width="700"}

If you activate the option for custom fields, then you see an submenu in
the backend.

![](as_j4_t_14_2.png "as_j4_t_14_2.png"){width="700"}

While editing an foo item, you see a tab, with all available custom
fields for this item.

![](as_j4_t_14_3.png "as_j4_t_14_3.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  14a   administrator/components/com\_foos/Helper/FooHelper.php                     the helper file                                                                                                                                                                       unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You never know how to integrate custom fields in the backend into your
component. In the next chapter, we'll look at how to display the values
in the frontend.

Adding Custom Fields in the frontend - Part 14b
===============================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.14.1</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if ($this->get('State')->get('params')->get('show_foo_name_label')) {
    echo Text::_('COM_FOOS_NAME') . $this->item->name;
} else {
    echo $this->item->name;
}
echo $this->item->event->afterDisplayTitle; 
echo $this->item->event->beforeDisplayContent;
echo $this->item->event->afterDisplayContent;
```

### Changing components/com\_foos/View/Foo/HtmlView.php

The `components/com_foos/View/Foo/HtmlView.php` file is ....

#### Completed components/com\_foos/View/Foo/HtmlView.php file

The code for the `components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The item object details
     *
     * @var    \JObject
     * @since  1.0.0
     */
    protected $item;

    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $item = $this->item = $this->get('Item');

        Factory::getApplication()->triggerEvent('onContentPrepare', array ('com_foos.foo', &$item));

        // Store the events for later
        $item->event = new \stdClass;
        $results = Factory::getApplication()->triggerEvent('onContentAfterTitle', array('com_foos.foo', &$item, &$item->params));
        $item->event->afterDisplayTitle = trim(implode("\n", $results));

        $results = Factory::getApplication()->triggerEvent('onContentBeforeDisplay', array('com_foos.foo', &$item, &$item->params));
        $item->event->beforeDisplayContent = trim(implode("\n", $results));

        $results = Factory::getApplication()->triggerEvent('onContentAfterDisplay', array('com_foos.foo', &$item, &$item->params));
        $item->event->afterDisplayContent = trim(implode("\n", $results));

        return parent::display($tpl);
    }
}
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You can edit the value of a custom field in the backend.

![](as_j4_t_14b_1.png "as_j4_t_14b_1.png"){width="700"}

After that you can show the value for a custom field in the front end.

![](as_j4_t_14b_2.png "as_j4_t_14b_2.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  14a   administrator/components/com\_foos/Helper/FooHelper.php                     the helper file                                                                                                                                                                       unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Your components can now fully use custom fields. This is a huge
advantage because cusotm fields make joomla and every component in
Joomla user friendly and customizable.

Adding Associations I - Part 15a
================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev). The installation should be multilingual.

File Structure
--------------

### Changing administrator/components/com\_foos/Extension/FoosComponent.php

The `administrator/components/com_foos/Extension/FoosComponent.php` file
is ....

#### Completed administrator/components/com\_foos/Extension/FoosComponent.php file

The code for the
`administrator/components/com_foos/Extension/FoosComponent.php` file is
as follows:

``` {.xml}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Association\AssociationServiceInterface;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Joomla\Component\Foos\Administrator\Service\HTML\AdministratorService;

/**
 * Component class for com_foos
 *
 * @since  1.0.0
 */
class FoosComponent extends MVCComponent
implements BootableExtensionInterface, CategoryServiceInterface, AssociationServiceInterface
{
    use CategoryServiceTrait;
    use AssociationServiceTrait;
    use HTMLRegistryAwareTrait;

    /**
     * Booting the extension. This is the function to set up the environment of the extension like
     * registering new class loaders, etc.
     *
     * If required, some initial set up can be done from services of the container, eg.
     * registering HTML services.
     *
     * @param   ContainerInterface  $container  The container
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function boot(ContainerInterface $container)
    {
        $this->getRegistry()->register('foosadministrator', new AdministratorService);
    }

    /**
     * Returns the table for the count items functions for the given section.
     *
     * @param   string  $section  The section
     *
     * @return  string|null
     *
     * @since   1.0.0
     */
    protected function getTableNameForSection(string $section = null)
    {
        return ($section === 'category' ? 'categories' : 'foos_details');
    }
}
```

### Changing administrator/components/com\_foos/Model/FooModel.php

The `administrator/components/com_foos/Model/FooModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FooModel.php file

The code for the `administrator/components/com_foos/Model/FooModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\LanguageHelper;

/**
 * Item Model for a Foo.
 *
 * @since  1.0
 */
class FooModel extends AdminModel
{
    /**
     * The type alias for this content type.
     *
     * @var    string
     * @since  1.0
     */
    public $typeAlias = 'com_foos.foo';

    /**
     * The context used for the associations table
     *
     * @var    string
     * @since  3.4.4
     */
    protected $associationsContext = 'com_foos.item';

    /**
     * Method to get the row form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  \JForm|boolean  A \JForm object on success, false on failure
     *
     * @since   1.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_foos.foo', 'foo', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.0
     */
    protected function loadFormData()
    {
        $app = Factory::getApplication();

        $data = $this->getItem();

        $this->preprocessData('com_foos.foo', $data);

        return $data;
    }

    /**
     * Method to get a single record.
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed  Object on success, false on failure.
     *
     * @since   1.0
     */
    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        // Load associated foo items
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $item->associations = array();
            $item->alias = "test";

            if ($item->id != null)
            {
                $associations = Associations::getAssociations('com_foos', '#__foos_details', 'com_foos.item', $item->id, 'id', null);

                foreach ($associations as $tag => $association)
                {
                    $item->associations[$tag] = $association->id;
                }
            }
        }

        return $item;
    }

    /**
     * Preprocess the form.
     *
     * @param   \JForm  $form   Form object.
     * @param   object  $data   Data object.
     * @param   string  $group  Group name.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function preprocessForm(\JForm $form, $data, $group = 'content')
    {
        // Association contact items
        if (Associations::isEnabled())
        {
            $languages = LanguageHelper::getContentLanguages(false, true, null, 'ordering', 'asc');

            if (count($languages) > 1)
            {
                $addform = new \SimpleXMLElement('<form />');
                $fields = $addform->addChild('fields');
                $fields->addAttribute('name', 'associations');
                $fieldset = $fields->addChild('fieldset');
                $fieldset->addAttribute('name', 'item_associations');

                foreach ($languages as $language)
                {
                    $field = $fieldset->addChild('field');
                    $field->addAttribute('name', $language->lang_code);
                    $field->addAttribute('type', 'modal_foo');
                    $field->addAttribute('language', $language->lang_code);
                    $field->addAttribute('label', $language->title);
                    $field->addAttribute('translate_label', 'false');
                    $field->addAttribute('select', 'true');
                    $field->addAttribute('new', 'true');
                    $field->addAttribute('edit', 'true');
                    $field->addAttribute('clear', 'true');
                }

                $form->load($addform, false);
            }
        }

        parent::preprocessForm($form, $data, $group);
    }
}
```

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FooModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(array('a.id', 'a.name', 'a.catid', 'a.access', 'a.published', 'a.publish_up', 'a.publish_down', 'a.language'))
        );

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(
                explode(
                    ', ',
                    $this->getState(
                        'list.select',
                        'a.id, a.name, a.catid' .
                        ', a.access' .
                        ', a.language' .
                        ', a.published' .
                        ', a.publish_up, a.publish_down'
                    )
                )
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.catid',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        return $query;
    }
}
```

### Changing administrator/components/com\_foos/Service/HTML/AdministratorService.php

The
`administrator/components/com_foos/Service/HTML/AdministratorService.php`
file is ....

#### Completed administrator/components/com\_foos/Service/HTML/AdministratorService.php file

The code for the
`administrator/components/com_foos/Service/HTML/AdministratorService.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Service\HTML;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/**
 * Foos HTML helper class.
 *
 * @since  1.0
 */
class AdministratorService
{
    /**
     * Get the associated language flags
     *
     * @param   integer  $fooid  The item id to search associations
     *
     * @return  string  The language HTML
     *
     * @throws  Exception
     */
    public function association($fooid)
    {
        // Defaults
        $html = '';

        // Get the associations
        if ($associations = Associations::getAssociations('com_foos', '#__foos_details', 'com_foos.item', $fooid, 'id', null))
        {
            foreach ($associations as $tag => $associated)
            {
                $associations[$tag] = (int) $associated->id;
            }

            // Get the associated foo items
            $db = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select('c.id, c.name as title')
                ->select('l.sef as lang_sef, lang_code')
                ->from('#__foos_details as c')
                ->select('cat.title as category_title')
                ->join('LEFT', '#__categories as cat ON cat.id=c.catid')
                ->where('c.id IN (' . implode(',', array_values($associations)) . ')')
                ->where('c.id != ' . $fooid)
                ->join('LEFT', '#__languages as l ON c.language=l.lang_code')
                ->select('l.image')
                ->select('l.title as language_title');
            $db->setQuery($query);

            try
            {
                $items = $db->loadObjectList('id');
            }
            catch (\RuntimeException $e)
            {
                throw new \Exception($e->getMessage(), 500, $e);
            }

            if ($items)
            {
                foreach ($items as &$item)
                {
                    $text = strtoupper($item->lang_sef);
                    $url = Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id);
                    $tooltip = htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8') . '<br>' . Text::sprintf('JCATEGORY_SPRINTF', $item->category_title);
                    $classes = 'hasPopover badge badge-secondary';

                    $item->link = '<a href="' . $url . '" title="' . $item->language_title . '" class="' . $classes
                        . '" data-content="' . $tooltip . '" data-placement="top">'
                        . $text . '</a>';
                }
            }

            HTMLHelper::_('bootstrap.popover');

            $html = LayoutHelper::render('joomla.content.associations', $items);
        }

        return $html;
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.15.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
            >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
            >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />
    </fieldset>
</form>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.ini}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_EDIT_FOO="Edit Foo"
COM_FOOS_NEW_FOO="New Foo"

COM_FOOS_HEADING_ASSOCIATION="Association"
COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"
```

### Changing administrator/components/com\_foos/services/provider.php

The `administrator/components/com_foos/services/provider.php` file is
....

#### Completed administrator/components/com\_foos/services/provider.php file

The code for the
`administrator/components/com_foos/services/provider.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Component\Foos\Administrator\Extension\FoosComponent;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\CategoryFactory;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\HTML\Registry;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Component\Foos\Administrator\Helper\AssociationsHelper;
use Joomla\CMS\Association\AssociationExtensionInterface;


/**
 * The foos service provider.
 * https://github.com/joomla/joomla-cms/pull/20217
 *
 * @since  1.0.0
 */
return new class implements ServiceProviderInterface
{
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function register(Container $container)
    {
        $container->set(AssociationExtensionInterface::class, new AssociationsHelper);

        $container->registerServiceProvider(new CategoryFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\Foos'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\Foos'));

        $container->set(
            ComponentInterface::class,
            function (Container $container)
            {
                $component = new FoosComponent($container->get(ComponentDispatcherFactoryInterface::class));

                $component->setRegistry($container->get(Registry::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));
                $component->setCategoryFactory($container->get(CategoryFactoryInterface::class));
                $component->setAssociationExtension($container->get(AssociationExtensionInterface::class));

                return $component;
            }
        );
    }
};
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

$assoc = Associations::isEnabled();

$this->ignore_fieldsets = array('item_associations');
$this->useCoreUI = true;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">
    <div>
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', empty($this->item->id) ? Text::_('COM_FOOS_NEW_FOO') : Text::_('COM_FOOS_EDIT_FOO')); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->getForm()->renderField('name'); ?>
                        <?php echo $this->getForm()->renderField('access'); ?>
                        <?php echo $this->getForm()->renderField('published'); ?>
                        <?php echo $this->getForm()->renderField('publish_up'); ?>
                        <?php echo $this->getForm()->renderField('publish_down'); ?>
                        <?php echo $this->getForm()->renderField('catid'); ?>
                        <?php echo $this->getForm()->renderField('language'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php if ( ! $isModal && $assoc) : ?>
            <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'associations', Text::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
            <?php echo $this->loadTemplate('associations'); ?>
            <?php echo HTMLHelper::_('uitab.endTab'); ?>
        <?php elseif ($isModal && $assoc) : ?>
            <div class="hidden"><?php echo $this->loadTemplate('associations'); ?></div>
        <?php endif; ?>
        
        <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

        <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    </div>

        <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;

$canChange  = true;
$assoc = Associations::isEnabled();
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <thead>
                            <tr>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_NAME'); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo TEXT::_('JGRID_HEADING_ACCESS') ?>
                                </th>
                                <?php if ($assoc) : ?>
                                    <th scope="col" style="width:10%">
                                        <?php echo Text::_('COM_FOOS_HEADING_ASSOCIATION'); ?>
                                    </th>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                        <?php echo Text::_('JGRID_HEADING_LANGUAGE'); ?>
                                    </th>
                                <?php endif; ?>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo Text::_('JSTATUS'); ?>
                                </th>
                                <th scope="col">
                                    <?php echo Text::_('COM_FOOS_TABLE_TABLEHEAD_ID'); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <?php if ($assoc) : ?>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($item->association) : ?>
                                        <?php 
                                        echo HTMLHelper::_('foosadministrator.association', $item->id); 
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <td class="small d-none d-md-table-cell">
                                        <?php echo LayoutHelper::render('joomla.content.language', $item); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

### Creating administrator/components/com\_foos/Helper/AssociationsHelper.php

The `administrator/components/com_foos/Helper/AssociationsHelper.php`
file is ....

#### Completed administrator/components/com\_foos/Helper/AssociationsHelper.php file

The code for the
`administrator/components/com_foos/Helper/AssociationsHelper.php` file
is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

echo LayoutHelper::render('joomla.edit.associations', $this);
```

### Creating administrator/components/com\_foos/sql/updates/mysql/1.15.0.sql

The `administrator/components/com_foos/sql/updates/mysql/1.15.0.sql`
file is ....

#### Completed administrator/components/com\_foos/sql/updates/mysql/1.15.0.sql file

The code for the
`administrator/components/com_foos/sql/updates/mysql/1.15.0.sql` file is
as follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `language` char(7) NOT NULL DEFAULT '*' AFTER `alias`;

ALTER TABLE `#__foos_details` ADD KEY `idx_language` (`language`);
```

### Creating administrator/components/com\_foos/tmpl/foo/edit\_associations.php

The `administrator/components/com_foos/tmpl/foo/edit_associations.php`
file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit\_associations.php file

The code for the
`administrator/components/com_foos/tmpl/foo/edit_associations.php` file
is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Association\AssociationExtensionHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Table\Table;
use Joomla\Component\Foos\Site\Helper\AssociationHelper;

/**
 * Content associations helper.
 *
 * @since  3.7.0
 */
class AssociationsHelper extends AssociationExtensionHelper
{
    /**
     * The extension name
     *
     * @var     array   $extension
     *
     * @since   3.7.0
     */
    protected $extension = 'com_foos';

    /**
     * Array of item types
     *
     * @var     array   $itemTypes
     *
     * @since   3.7.0
     */
    protected $itemTypes = array('foo', 'category');

    /**
     * Has the extension association support
     *
     * @var     boolean   $associationsSupport
     *
     * @since   3.7.0
     */
    protected $associationsSupport = true;

    /**
     * Method to get the associations for a given item.
     *
     * @param   integer  $id    Id of the item
     * @param   string   $view  Name of the view
     *
     * @return  array   Array of associations for the item
     *
     * @since  1.0.0
     */
    public function getAssociationsForItem($id = 0, $view = null)
    {
        return AssociationHelper::getAssociations($id, $view);
    }

    /**
     * Get the associated items for an item
     *
     * @param   string  $typeName  The item type
     * @param   int     $id        The id of item for which we need the associated items
     *
     * @return  array
     *
     * @since   3.7.0
     */
    public function getAssociations($typeName, $id)
    {
        $type = $this->getType($typeName);

        $context    = $this->extension . '.item';
        $catidField = 'catid';

        if ($typeName === 'category')
        {
            $context    = 'com_categories.item';
            $catidField = '';
        }

        // Get the associations.
        $associations = Associations::getAssociations(
            $this->extension,
            $type['tables']['a'],
            $context,
            $id,
            'id',
            'alias',
            $catidField
        );

        return $associations;
    }

    /**
     * Get item information
     *
     * @param   string  $typeName  The item type
     * @param   int     $id        The id of item for which we need the associated items
     *
     * @return  Table|null
     *
     * @since   3.7.0
     */
    public function getItem($typeName, $id)
    {
        if (empty($id))
        {
            return null;
        }

        $table = null;

        switch ($typeName)
        {
            case 'foo':
                $table = Table::getInstance('FooTable', 'Joomla\\Component\\Foos\\Administrator\\Table\\');
                break;

            case 'category':
                $table = Table::getInstance('Category');
                break;
        }

        if (empty($table))
        {
            return null;
        }

        $table->load($id);

        return $table;
    }

    /**
     * Get information about the type
     *
     * @param   string  $typeName  The item type
     *
     * @return  array  Array of item types
     *
     * @since   3.7.0
     */
    public function getType($typeName = '')
    {
        $fields  = $this->getFieldsTemplate();
        $tables  = array();
        $joins   = array();
        $support = $this->getSupportTemplate();
        $title   = '';

        if (in_array($typeName, $this->itemTypes))
        {
            switch ($typeName)
            {
                case 'foo':
                    $fields['title'] = 'a.name';
                    $fields['state'] = 'a.published';

                    $support['state'] = true;
                    $support['acl'] = true;
                    $support['category'] = true;
                    $support['save2copy'] = true;

                    $tables = array(
                        'a' => '#__foos_details'
                    );

                    $title = 'foo';
                    break;

                case 'category':
                    $fields['created_user_id'] = 'a.created_user_id';
                    $fields['ordering'] = 'a.lft';
                    $fields['level'] = 'a.level';
                    $fields['catid'] = '';
                    $fields['state'] = 'a.published';

                    $support['state'] = true;
                    $support['acl'] = true;
                    $support['checkout'] = true;
                    $support['level'] = true;

                    $tables = array(
                        'a' => '#__categories'
                    );

                    $title = 'category';
                    break;
            }
        }

        return array(
            'fields'  => $fields,
            'support' => $support,
            'tables'  => $tables,
            'joins'   => $joins,
            'title'   => $title
        );
    }
}
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.
It is also important that you have more than one language installed and
that the System - Language Filter plugin is enabled. Furthermore, it is
necessary that you create a content language.

![](as_j4_t_15a_1.png "as_j4_t_15a_1.png"){width="700"}

You have to run a new installation or fix the database due to the
changes in the database.

![](as_j4_t_15a_2.png "as_j4_t_15a_2.png"){width="700"}

After that you see a new tab with the name associations. Here you can
select an association.

![](as_j4_t_15a_3.png "as_j4_t_15a_3.png"){width="700"}

![](as_j4_t_15a_4.png "as_j4_t_15a_4.png"){width="700"}

At the moment all items are offered. Even those who are in the same
language. It would be ideal if only the items are offered, which also
match the linked language. We will do that later.

In the default view of com\_foo you can see a column where the
associations are shown.

![](as_j4_t_15a_5.png "as_j4_t_15a_5.png"){width="700"}

And you can translate the items with the help of the component
Multilingual Assocciations.

![](as_j4_t_15a_6.png "as_j4_t_15a_6.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  14a   administrator/components/com\_foos/Helper/FooHelper.php                     the helper file                                                                                                                                                                       unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  15    administrator/components/com\_foos/Helper/AssociationsHelper.php            the helper file for associations                                                                                                                                                      new
  15    administrator/components/com\_foos/tmpl/foo/edit\_associations.ph           the template for editing associations                                                                                                                                                 new
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Your component is now fit for Multilingual Website. You support the
Joomla own functions. In the next chapter we will make this even more
user-friendly.

Adding Associations II - Part 15b
=================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Field/Modal/FooField.php

The `administrator/components/com_foos/Field/Modal/FooField.php` file is
....

#### Completed administrator/components/com\_foos/Field/Modal/FooField.php file

The code for the
`administrator/components/com_foos/Field/Modal/FooField.php` file is as
follows:

``` {.php}
<?php
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Field\Modal;

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

/**
 * Supports a modal foo picker.
 *
 * @since  1.0
 */
class FooField extends FormField
{
    /**
     * The form field type.
     *
     * @var     string
     * @since   1.0
     */
    protected $type = 'Modal_Foo';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   1.0
     */
    protected function getInput()
    {
        $allowClear  = ((string) $this->element['clear'] != 'false');
        $allowSelect = ((string) $this->element['select'] != 'false');

        // The active foo id field.
        $value = (int) $this->value > 0 ? (int) $this->value : '';

        // Create the modal id.
        $modalId = 'Foo_' . $this->id;

        // Add the modal field script to the document head.
        HTMLHelper::_('script', 'system/fields/modal-fields.min.js', array('version' => 'auto', 'relative' => true));

        // Script to proxy the select modal function to the modal-fields.js file.
        if ($allowSelect)
        {
            static $scriptSelect = null;

            if (is_null($scriptSelect))
            {
                $scriptSelect = array();
            }

            if (!isset($scriptSelect[$this->id]))
            {
                Factory::getDocument()->addScriptDeclaration("
                function jSelectFoo_" . $this->id . "(id, title, object) {
                    window.processModalSelect('Foo', '" . $this->id . "', id, title, '', object);
                }
                "
                );

                $scriptSelect[$this->id] = true;
            }
        }

        // Setup variables for display.
        $linkFoos = 'index.php?option=com_foos&amp;view=foos&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $linkFoo  = 'index.php?option=com_foos&amp;view=foo&amp;layout=modal&amp;tmpl=component&amp;' . Session::getFormToken() . '=1';
        $modalTitle   = Text::_('COM_FOOS_CHANGE_FOO');

        if (isset($this->element['language']))
        {
            $linkFoos .= '&amp;forcedLanguage=' . $this->element['language'];
            $linkFoo   .= '&amp;forcedLanguage=' . $this->element['language'];
            $modalTitle     .= ' &#8212; ' . $this->element['label'];
        }

        $urlSelect = $linkFoos . '&amp;function=jSelectFoo_' . $this->id;

        if ($value)
        {
            $db    = Factory::getDbo();
            $query = $db->getQuery(true)
                ->select($db->quoteName('name'))
                ->from($db->quoteName('#__foos_details'))
                ->where($db->quoteName('id') . ' = ' . (int) $value);
            $db->setQuery($query);

            try
            {
                $title = $db->loadResult();
            }
            catch (\RuntimeException $e)
            {
                Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
            }
        }

        $title = empty($title) ? Text::_('COM_FOOS_SELECT_A_FOO') : htmlspecialchars($title, ENT_QUOTES, 'UTF-8');

        // The current foo display field.
        $html  = '';

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '<span class="input-group">';
        }

        $html .= '<input class="form-control" id="' . $this->id . '_name" type="text" value="' . $title . '" disabled="disabled" size="35">';

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '<span class="input-group-append">';
        }

        // Select foo button
        if ($allowSelect)
        {
            $html .= '<button'
                . ' class="btn btn-primary hasTooltip' . ($value ? ' hidden' : '') . '"'
                . ' id="' . $this->id . '_select"'
                . ' data-toggle="modal"'
                . ' type="button"'
                . ' data-target="#ModalSelect' . $modalId . '"'
                . ' title="' . HTMLHelper::tooltipText('COM_FOOS_CHANGE_FOO') . '">'
                . '<span class="icon-file" aria-hidden="true"></span> ' . Text::_('JSELECT')
                . '</button>';
        }

        // Clear foo button
        if ($allowClear)
        {
            $html .= '<button'
                . ' class="btn btn-secondary' . ($value ? '' : ' hidden') . '"'
                . ' id="' . $this->id . '_clear"'
                . ' type="button"'
                . ' onclick="window.processModalParent(\'' . $this->id . '\'); return false;">'
                . '<span class="icon-remove" aria-hidden="true"></span>' . Text::_('JCLEAR')
                . '</button>';
        }

        if ($allowSelect || $allowNew || $allowEdit || $allowClear)
        {
            $html .= '</span></span>';
        }

        // Select foo modal
        if ($allowSelect)
        {
            $html .= HTMLHelper::_(
                'bootstrap.renderModal',
                'ModalSelect' . $modalId,
                array(
                    'title'       => $modalTitle,
                    'url'         => $urlSelect,
                    'height'      => '400px',
                    'width'       => '800px',
                    'bodyHeight'  => 70,
                    'modalWidth'  => 80,
                    'footer'      => '<a role="button" class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">'
                                        . Text::_('JLIB_HTML_BEHAVIOR_CLOSE') . '</a>',
                )
            );
        }

        // Note: class='required' for client side validation.
        $class = $this->required ? ' class="required modal-value"' : '';

        $html .= '<input type="hidden" id="' . $this->id . '_id"' . $class . ' data-required="' . (int) $this->required . '" name="' . $this->name
            . '" data-text="' . htmlspecialchars(Text::_('COM_FOOS_SELECT_A_FOO', true), ENT_COMPAT, 'UTF-8') . '" value="' . $value . '">';

        return $html;
    }

    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     *
     * @since   1.0
     */
    protected function getLabel()
    {
        return str_replace($this->id, $this->id . '_name', parent::getLabel());
    }
}
```

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }
    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $db->quoteName(array('a.id', 'a.name', 'a.catid', 'a.access', 'a.published', 'a.publish_up', 'a.publish_down', 'a.language'))
        );

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id AS id,'
                . 'a.name AS name,'
                . 'a.access,'
                . 'a.language,'
                . 'a.state AS state,'
                . 'a.catid AS catid,'
                . 'a.published AS published,'
                . 'a.publish_up,'
                . 'a.publish_down'
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.catid',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        // Filter on the language.
        if ($language = $this->getState('filter.language'))
        {
            $query->where($db->quoteName('a.language') . ' = :language');
            $query->bind(':language', $language);
        }
        
        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        $app = Factory::getApplication();

        $forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

        // Adjust the context to support modal layouts.
        if ($layout = $app->input->get('layout'))
        {
            $this->context .= '.' . $layout;
        }

        // Adjust the context to support forced languages.
        if ($forcedLanguage)
        {
            $this->context .= '.' . $forcedLanguage;
        }

        // List state information.
        parent::populateState($ordering, $direction);

        // Force a language.
        if (!empty($forcedLanguage))
        {
            $this->setState('filter.language', $forcedLanguage);
        }
    }
}
```

### Changing administrator/components/com\_foos/View/Foo/HtmlView.php

The `administrator/components/com_foos/View/Foo/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foo/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit a foo.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The \JForm object
     *
     * @var  \JForm
     */
    protected $form;

    /**
     * The active item
     *
     * @var  object
     */
    protected $item;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        // If we are forcing a language in modal (used for associations).
        if ($this->getLayout() === 'modal' && $forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'cmd'))
        {
            // Set the language field to the forcedLanguage and disable changing it.
            $this->form->setValue('language', null, $forcedLanguage);
            $this->form->setFieldAttribute('language', 'readonly', 'true');

            // Only allow to select categories with All language or with the forced language.
            $this->form->setFieldAttribute('catid', 'language', '*,' . $forcedLanguage);
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        Factory::getApplication()->input->set('hidemainmenu', true);

        $isNew = ($this->item->id == 0);

        ToolbarHelper::title($isNew ? Text::_('COM_FOOS_MANAGER_FOO_NEW') : Text::_('COM_FOOS_MANAGER_FOO_EDIT'), 'address foo');

        ToolbarHelper::apply('foo.apply');
        ToolbarHelper::cancel('foo.cancel', 'JTOOLBAR_CLOSE');
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php


/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;


/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos');

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        if ($canDo->get('core.create'))
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.options'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.15.1</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

Now the items in the modal are filtered.

![](as_j4_t_15b_1.png "as_j4_t_15b_1.png"){width="700"}

Component Contents
------------------

Adding Ordering and Filter - Part 16
====================================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'catid', 'a.catid', 'category_id', 'category_title',
                'published', 'a.published',
                'access', 'a.access', 'access_level',
                'ordering', 'a.ordering',
                'language', 'a.language', 'language_title',
                'publish_up', 'a.publish_up',
                'publish_down', 'a.publish_down',
            );

            $assoc = Associations::isEnabled();

            if ($assoc)
            {
                $config['filter_fields'][] = 'association';
            }
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id AS id,'
                . 'a.name AS name,'
                . 'a.access,'
                . 'a.language,'
                . 'a.ordering AS ordering,'
                . 'a.state AS state,'
                . 'a.catid AS catid,'
                . 'a.published AS published,'
                . 'a.publish_up,'
                . 'a.publish_down'
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.catid',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        // Filter by access level.
        if ($access = $this->getState('filter.access'))
        {
            $query->where($db->quoteName('a.access') . ' = ' . (int) $access);
        }

        // Filter by published state
        $published = (string) $this->getState('filter.published');

        if (is_numeric($published))
        {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
        }

        // Filter by a single or group of categories.
        $categoryId = $this->getState('filter.category_id');

        if (is_numeric($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' = ' . (int) $categoryId);
        }
        elseif (is_array($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' IN (' . implode(',', ArrayHelper::toInteger($categoryId)) . ')');
        }

        // Filter by search in name.
        $search = $this->getState('filter.search');

        if (!empty($search))
        {
            if (stripos($search, 'id:') === 0)
            {
                $query->where('a.id = ' . (int) substr($search, 3));
            }
            else
            {
                $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
                $query->where(
                    '(' . $db->quoteName('a.name') . ' LIKE ' . $search . ')'
                );
            }
        }

        // Filter on the language.
        if ($language = $this->getState('filter.language'))
        {
            $query->where($db->quoteName('a.language') . ' = ' . $db->quote($language));
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        if ($orderCol == 'a.ordering' || $orderCol == 'category_title')
        {
            $orderCol = $db->quoteName('c.title') . ' ' . $orderDirn . ', ' . $db->quoteName('a.ordering');
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        $app = Factory::getApplication();

        $forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

        // Adjust the context to support modal layouts.
        if ($layout = $app->input->get('layout'))
        {
            $this->context .= '.' . $layout;
        }

        // Adjust the context to support forced languages.
        if ($forcedLanguage)
        {
            $this->context .= '.' . $forcedLanguage;
        }

        // List state information.
        parent::populateState($ordering, $direction);

        // Force a language.
        if (!empty($forcedLanguage))
        {
            $this->setState('filter.language', $forcedLanguage);
        }
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos');

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOOS_MANAGER_FOOS'), 'address foo');

        if ($canDo->get('core.create'))
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.options'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }
    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?php
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.16.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
         />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
            >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
            >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />

        <field
            name="ordering"
            type="ordering"
            label="JFIELD_ORDERING_LABEL"
            content_type="com_foos.foo"
        />

    </fieldset>
</form>
```

### Create administrator/components/com\_foos/sql/updates/mysql/1.16.0.sql

The `administrator/components/com_foos/sql/updates/mysql/1.16.0.sql`
file is ....

#### Completed administrator/components/com\_foos/sql/updates/mysql/1.16.0.sql file

The code for the
`administrator/components/com_foos/sql/updates/mysql/1.16.0.sql` file is
as follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `ordering` int(11) NOT NULL DEFAULT 0 AFTER `alias`;
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Session\Session;

$canChange  = true;
$assoc = Associations::isEnabled();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder && !empty($this->items))
{
    $saveOrderingUrl = 'index.php?option=com_foos&task=foos.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
}
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <caption id="captionTable" class="sr-only">
                            <?php echo Text::_('COM_FOOS_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
                                </th>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_TABLE_TABLEHEAD_NAME', 'a.name', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
                                </th>
                                <?php if ($assoc) : ?>
                                    <th scope="col" style="width:10%">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language_title', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="order text-center d-none d-md-table-cell">
                                    <?php
                                    $iconClass = '';
                                    if (!$canChange)
                                    {
                                        $iconClass = ' inactive';
                                    }
                                    elseif (!$saveOrder)
                                    {
                                        $iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::_('tooltipText', 'JORDERINGDISABLED');
                                    }
                                    ?>
                                    <span class="sortable-handler<?php echo $iconClass; ?>">
                                        <span class="icon-menu" aria-hidden="true"></span>
                                    </span>
                                    <?php if ($canChange && $saveOrder) : ?>
                                        <input type="text" style="display:none" name="order[]" size="5"
                                            value="<?php echo $item->ordering; ?>" class="width-20 text-area-order">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <?php if ($assoc) : ?>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($item->association) : ?>
                                        <?php 
                                        echo HTMLHelper::_('foosadministrator.association', $item->id); 
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <td class="small d-none d-md-table-cell">
                                        <?php echo LayoutHelper::render('joomla.content.language', $item); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/modal.php

The `administrator/components/com_foos/tmpl/foos/modal.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foos/modal.php file

The code for the `administrator/components/com_foos/tmpl/foos/modal.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;

$app = Factory::getApplication();

HTMLHelper::_('script', 'com_foos/admin-foos-modal.min.js', array('version' => 'auto', 'relative' => true));

$function  = $app->input->getCmd('function', 'jSelectFoos');
$onclick   = $this->escape($function);
?>
<div class="container-popup">

    <form action="<?php echo Route::_('index.php?option=com_foos&view=foos&layout=modal&tmpl=component&function=' . $function . '&' . Session::getFormToken() . '=1'); ?>" method="post" name="adminForm" id="adminForm" class="form-inline">

        <?php if (empty($this->items)) : ?>
            <div class="alert alert-warning">
                <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
            </div>
        <?php else : ?>
            <table class="table table-sm">
                <thead>
                    <caption id="captionTable" class="sr-only">
                        <?php echo Text::_('COM_FOOS_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
                    </caption>
                    <tr>
                        <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                        </th>
                        <th scope="col" style="width:1%">
                        </th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $iconStates = array(
                    -2 => 'icon-trash',
                    0  => 'icon-unpublish',
                    1  => 'icon-publish',
                    2  => 'icon-archive',
                );
                ?>
                <?php foreach ($this->items as $i => $item) : ?>
                    <?php $lang = ''; ?>
                    <tr class="row<?php echo $i % 2; ?>">
                        <th scope="row">
                            <a class="select-link" href="javascript:void(0)" data-function="<?php echo $this->escape($onclick); ?>" data-id="<?php echo $item->id; ?>" data-title="<?php echo $this->escape($item->name); ?>">
                                <?php echo $this->escape($item->name); ?>
                            </a>
                        </th>
                        <td>
                            <?php echo (int) $item->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

        <input type="hidden" name="task" value="">
        <input type="hidden" name="forcedLanguage" value="<?php echo $app->input->get('forcedLanguage', '', 'CMD'); ?>">
        <?php echo HTMLHelper::_('form.token'); ?>

    </form>
</div>
```

Test your component
-------------------

Now you can zip all files and install them via Joomla Extension Manager.

You have to run a new installation or fix the database due to the
changes in the database.

These few changes allow you to sort and filter in your component. You
use Joomla functions here and do not have to invent the wheel yourself.

Example in Joomla!
------------------

![](as_j4_t_16_1.png "as_j4_t_16_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  14a   administrator/components/com\_foos/Helper/FooHelper.php                     the helper file                                                                                                                                                                       unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  15    administrator/components/com\_foos/Helper/AssociationsHelper.php            the helper file for associations                                                                                                                                                      unchanged
  15    administrator/components/com\_foos/tmpl/foo/edit\_associations.php          the template for editing associations                                                                                                                                                 unchanged
  16    administrator/components/com\_foos/forms/filter\_foos.xml                   the form for the filter                                                                                                                                                               new
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Adding Actions - Part 17
========================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/View/Foo/HtmlView.php

The `administrator/components/com_foos/View/Foo/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foo/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit a foo.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The \JForm object
     *
     * @var  \JForm
     */
    protected $form;

    /**
     * The active item
     *
     * @var  object
     */
    protected $item;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        // If we are forcing a language in modal (used for associations).
        if ($this->getLayout() === 'modal' && $forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'cmd'))
        {
            // Set the language field to the forcedLanguage and disable changing it.
            $this->form->setValue('language', null, $forcedLanguage);
            $this->form->setFieldAttribute('language', 'readonly', 'true');

            // Only allow to select categories with All language or with the forced language.
            $this->form->setFieldAttribute('catid', 'language', '*,' . $forcedLanguage);
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        Factory::getApplication()->input->set('hidemainmenu', true);

        $user       = Factory::getUser();
        $userId     = $user->id;
        $isNew      = ($this->item->id == 0);

        ToolbarHelper::title($isNew ? Text::_('COM_FOOS_MANAGER_FOO_NEW') : Text::_('COM_FOOS_MANAGER_FOO_EDIT'), 'address foo');

        // Since we don't track these assets at the item level, use the category id.
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->item->catid);

        // Build the actions for new and existing records.
        if ($isNew)
        {
            // For new records, check the create permission.
            if ($isNew && (count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0))
            {
                ToolbarHelper::apply('foo.apply');

                ToolbarHelper::saveGroup(
                    [
                        ['save', 'foo.save'],
                        ['save2new', 'foo.save2new']
                    ],
                    'btn-success'
                );
            }

            ToolbarHelper::cancel('foo.cancel');
        }
        else
        {
            // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
            $itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId);

            $toolbarButtons = [];

            // Can't save the record if it's not editable
            if ($itemEditable)
            {
                ToolbarHelper::apply('foo.apply');

                $toolbarButtons[] = ['save', 'foo.save'];

                // We can save this record, but check the create permission to see if we can return to make a new one.
                if ($canDo->get('core.create'))
                {
                    $toolbarButtons[] = ['save2new', 'foo.save2new'];
                }
            }

            // If checked out, we can still save
            if ($canDo->get('core.create'))
            {
                $toolbarButtons[] = ['save2copy', 'foo.save2copy'];
            }

            ToolbarHelper::saveGroup(
                $toolbarButtons,
                'btn-success'
            );

            if (Associations::isEnabled() && ComponentHelper::isEnabled('com_associations'))
            {
                ToolbarHelper::custom('foo.editAssociations', 'contract', 'contract', 'JTOOLBAR_ASSOCIATIONS', false, false);
            }

            ToolbarHelper::cancel('foo.cancel', 'JTOOLBAR_CLOSE');
        }
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->state->get('filter.category_id'));
        $user  = Factory::getUser();

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOO_MANAGER_FOOS'), 'address foos');

        if ($canDo->get('core.create') || count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0)
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.edit.state'))
        {
            $dropdown = $toolbar->dropdownButton('status-group')
                ->text('JTOOLBAR_CHANGE_STATUS')
                ->toggleSplit(false)
                ->icon('fa fa-globe')
                ->buttonClass('btn btn-info')
                ->listCheck(true);

            $childBar = $dropdown->getChildToolbar();

            $childBar->publish('foos.publish')->listCheck(true);

            $childBar->unpublish('foos.unpublish')->listCheck(true);

            $childBar->archive('foos.archive')->listCheck(true);

            if ($user->authorise('core.admin'))
            {
                $childBar->checkin('foos.checkin')->listCheck(true);
            }

            if ($this->state->get('filter.published') != -2)
            {
                $childBar->trash('foos.trash')->listCheck(true);
            }
        }

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            $toolbar->delete('foos.delete')
                ->text('JTOOLBAR_EMPTY_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->listCheck(true);
        }

        if ($user->authorise('core.admin', 'com_foos') || $user->authorise('core.options', 'com_foos'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.init}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_EDIT_FOO="Edit Foo"
COM_FOOS_NEW_FOO="New Foo"

COM_FOOS_HEADING_ASSOCIATION="Association"
COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"

COM_FOOS_TABLE_CAPTION="Foo Table Caption"

COM_FOOS_N_ITEMS_ARCHIVED="%d foos archived."
COM_FOOS_N_ITEMS_ARCHIVED_1="%d foo archived."
COM_FOOS_N_ITEMS_DELETED="%d foos deleted."
COM_FOOS_N_ITEMS_DELETED_1="%d foo deleted."
COM_FOOS_N_ITEMS_TRASHED="%d foos trashed."
COM_FOOS_N_ITEMS_TRASHED_1="%d foo trashed."
COM_FOO_MANAGER_FOOS="Foos"
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.17.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Example in Joomla!
------------------

Here you can see how you can use already implemented actions.

Here is an example of an actions in the edit view.

![](as_j4-t_17_1.png "as_j4-t_17_1.png"){width="700"}

Here is an example of an actions in the default view.

![](as_j4-t_17_2.png "as_j4-t_17_2.png"){width="700"}

Do you have a specific problem? Then look at how the standard functions
are implemented in Joomla and apply this analogously to your problem.

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1     administrator/components/com\_foos/Controller/DisplayController.php         this is the administrator entry point to the Foo component                                                                                                                            unchanged
  7     administrator/components/com\_foos/Controller/FooController.php             this is the entry point to the Foo component                                                                                                                                          unchanged
  1     administrator/components/com\_foos/Extension/FoosComponent.php              the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Field/FooField.php                       the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  7     administrator/components/com\_foos/Model/FooModel.php                       this is the model of the Foo component item                                                                                                                                           unchanged
  6     administrator/components/com\_foos/Model/FoosModel.php                      this is the model of the Foo component                                                                                                                                                unchanged
  1     administrator/components/com\_foos/Service/HTML/AdministratorService.php    the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  7     administrator/components/com\_foos/Table/FooTable.php                       the database table                                                                                                                                                                    unchanged
  1     administrator/components/com\_foos/View/Foos/HtmlView.php                   file representing the view in the back end                                                                                                                                            unchanged
  1     administrator/components/com\_foos/services/provider.php                    the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  unchanged
  6     administrator/components/com\_foos/sql/install.mysql.utf8.sql               During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  6     administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql             During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           unchanged
  7     administrator/components/com\_foos/forms/foo.xml                            the default form in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/edit.php                        the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foo/modal.php                       the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/tmpl/foos/default.php                    the default view in the back end                                                                                                                                                      unchanged
  7     administrator/components/com\_foos/tmpl/foos/modal.php                      the default view in the back end                                                                                                                                                      unchanged
  1     administrator/components/com\_foos/foos.xml                                 this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       unchanged
  1     administrator/components/com\_foos/script.php                               the installer script                                                                                                                                                                  unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini       the language file                                                                                                                                                                     unchanged
  8     administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini   the language file                                                                                                                                                                     unchanged
  9     administrator/components/com\_foos/config.php                               the configuration                                                                                                                                                                     unchanged
  10    administrator/components/com\_foos/access.xml                               the ACL file for permissen handling                                                                                                                                                   unchanged
  14a   administrator/components/com\_foos/Helper/FooHelper.php                     the helper file                                                                                                                                                                       unchanged
  11a   administrator/components/com\_foos/Rule/LetterRule.php                      the server side validation rule                                                                                                                                                       unchanged
  15    administrator/components/com\_foos/Helper/AssociationsHelper.php            the helper file for associations                                                                                                                                                      unchanged
  15    administrator/components/com\_foos/tmpl/foo/edit\_associations.php          the template for editing associations                                                                                                                                                 unchanged
  16    administrator/components/com\_foos/forms/filter\_foos.xml                   the form for the filter                                                                                                                                                               unchanged
  2     components/com\_foos/Controller/DisplayController.php                       this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4     components/com\_foos/Model/FooModel.php                                     this is the frond end model for the Foo component                                                                                                                                     unchanged
  2     components/com\_foos/View/Foo/HtmlView.php                                  file representing the view in the frond end                                                                                                                                           unchanged
  7     components/com\_foos/View/Foos/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2     components/com\_foos/tmpl/foo/default.php                                   the default view in the frond end                                                                                                                                                     unchanged
  3     components/com\_foos/tmpl/foo/default.xml                                   the xml for the menu item                                                                                                                                                             unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.ini                     the language file                                                                                                                                                                     unchanged
  8     components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini                 the language file                                                                                                                                                                     unchanged
  7     media/com\_foos/js/admin-foos-modal.js                                      the javascript file                                                                                                                                                                   unchanged
  11b   media/com\_foos/js/admin-foos-letter.js                                     the client side validation rule                                                                                                                                                       unchanged
  ----- --------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

With its own functions, you can implement almost anything you want. You
may want to save parameters that control the function of your component
in addition to the data. This is the topic of the next chapter

Adding Params - Part 18
=======================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'catid', 'a.catid', 'category_id', 'category_title',
                'published', 'a.published',
                'access', 'a.access', 'access_level',
                'ordering', 'a.ordering',
                'language', 'a.language', 'language_title',
                'publish_up', 'a.publish_up',
                'publish_down', 'a.publish_down',
            );

            $assoc = Associations::isEnabled();

            if ($assoc)
            {
                $config['filter_fields'][] = 'association';
            }
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id AS id,'
                . 'a.name AS name,'
                . 'a.access,'
                . 'a.language,'
                . 'a.ordering AS ordering,'
                . 'a.state AS state,'
                . 'a.catid AS catid,'
                . 'a.published AS published,'
                . 'a.publish_up,'
                . 'a.publish_down'
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.catid',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        // Filter by access level.
        if ($access = $this->getState('filter.access'))
        {
            $query->where($db->quoteName('a.access') . ' = ' . (int) $access);
        }

        // Filter by published state
        $published = (string) $this->getState('filter.published');

        if (is_numeric($published))
        {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
        }

        // Filter by a single or group of categories.
        $categoryId = $this->getState('filter.category_id');

        if (is_numeric($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' = ' . (int) $categoryId);
        }
        elseif (is_array($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' IN (' . implode(',', ArrayHelper::toInteger($categoryId)) . ')');
        }

        // Filter by search in name.
        $search = $this->getState('filter.search');

        if (!empty($search))
        {
            if (stripos($search, 'id:') === 0)
            {
                $query->where('a.id = ' . (int) substr($search, 3));
            }
            else
            {
                $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
                $query->where(
                    '(' . $db->quoteName('a.name') . ' LIKE ' . $search . ')'
                );
            }
        }

        // Filter on the language.
        if ($language = $this->getState('filter.language'))
        {
            $query->where($db->quoteName('a.language') . ' = ' . $db->quote($language));
        }

        // Filter by a single tag.
        $tagId = $this->getState('filter.tag');

        if (is_numeric($tagId))
        {
            $query->where($db->quoteName('tagmap.tag_id') . ' = ' . (int) $tagId)
                ->join(
                    'LEFT',
                    $db->quoteName('#__contentitem_tag_map', 'tagmap')
                    . ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('tagmap.type_alias') . ' = ' . $db->quote('com_foos.contact')
                );
        }

        // Filter on the level.
        if ($level = $this->getState('filter.level'))
        {
            $query->where('c.level <= ' . (int) $level);
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        if ($orderCol == 'a.ordering' || $orderCol == 'category_title')
        {
            $orderCol = $db->quoteName('c.title') . ' ' . $orderDirn . ', ' . $db->quoteName('a.ordering');
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        $app = Factory::getApplication();

        $forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

        // Adjust the context to support modal layouts.
        if ($layout = $app->input->get('layout'))
        {
            $this->context .= '.' . $layout;
        }

        // Adjust the context to support forced languages.
        if ($forcedLanguage)
        {
            $this->context .= '.' . $forcedLanguage;
        }

        // List state information.
        parent::populateState($ordering, $direction);

        // Force a language.
        if (!empty($forcedLanguage))
        {
            $this->setState('filter.language', $forcedLanguage);
        }
    }
}
```

### Changing administrator/components/com\_foos/Table/FooTable.php

The `administrator/components/com_foos/Table/FooTable.php` file is ....

#### Completed administrator/components/com\_foos/Table/FooTable.php file

The code for the `administrator/components/com_foos/Table/FooTable.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;

/**
 * Foos Table class.
 *
 * @since  1.0
 */
class FooTable extends Table
{
    /**
     * Constructor
     *
     * @param   DatabaseDriver  $db  Database connector object
     *
     * @since   1.0
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_foos.foo';

        parent::__construct('#__foos_details', 'id', $db);

         
    }

    /**
     * Stores a contact.
     *
     * @param   boolean  $updateNulls  True to update fields even if they are null.
     *
     * @return  boolean  True on success, false on failure.
     *
     * @since   1.0
     */
    public function store($updateNulls = false)
    {
        // Transform the params field
        if (is_array($this->params))
        {
            $registry = new Registry($this->params);
            $this->params = (string) $registry;
        }

        return parent::store($updateNulls);
    }

    /**
     * Overloaded check function
     *
     * @return  boolean
     *
     * @see     Table::check
     * @since   1.5
     */
    public function check()
    {
        try
        {
            parent::check();
        }
        catch (\Exception $e)
        {
            $this->setError($e->getMessage());

            return false;
        }

        // Set name
        $this->name = htmlspecialchars_decode($this->name, ENT_QUOTES);

        // Check the publish down date is not earlier than publish up.
        if ($this->publish_down > $this->_db->getNullDate() && $this->publish_down < $this->publish_up)
        {
            $this->setError(Text::_('JGLOBAL_START_PUBLISH_AFTER_FINISH'));

            return false;
        }

        if (empty($this->publish_up))
        {
            $this->publish_up = $this->getDbo()->getNullDate();
        }

        if (empty($this->publish_down))
        {
            $this->publish_down = $this->getDbo()->getNullDate();
        }

        return true;
    }
}
```

### Changing administrator/components/com\_foos/config.xml

The `administrator/components/com_foos/config.xml` file is ....

#### Completed administrator/components/com\_foos/config.xml file

The code for the `administrator/components/com_foos/config.xml` file is
as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<config>

    <fieldset
        name="foo"
        label="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY"
        description="COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC"
        >

        <field
            name="show_foo_name_label"
            type="list"
            label="COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>

        <field
            name="custom_fields_enable"
            type="radio"
            class="switcher"
            label="JGLOBAL_CUSTOM_FIELDS_ENABLE_LABEL"
            default="1"
            >
            <option value="0">JNO</option>
            <option value="1">JYES</option>
        </field>

        <field
            name="show_name"
            type="radio"
            label="COM_FOOS_FIELD_PARAMS_NAME_LABEL"
            default="1"
            class="switcher"
            >
            <option value="0">JHIDE</option>
            <option value="1">JSHOW</option>
        </field>

    </fieldset>
    <fieldset
        name="permissions"
        label="JCONFIG_PERMISSIONS_LABEL"
        description="JCONFIG_PERMISSIONS_DESC"
        >

        <field
            name="rules"
            type="rules"
            label="JCONFIG_PERMISSIONS_LABEL"
            validate="rules"
            filter="rules"
            component="com_foos"
            section="component"
        />

    </fieldset>
</config>
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.18.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
        />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
        >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
        >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />

        <field
            name="ordering"
            type="ordering"
            label="JFIELD_ORDERING_LABEL"
            content_type="com_foos.foo"
        />

    </fieldset>
    <fields name="params" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">
        <fieldset name="display" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">
            <field
                name="show_name"
                type="list"
                label="COM_FOOS_FIELD_PARAMS_NAME_LABEL"
                useglobal="true"
            >
                <option value="0">JHIDE</option>
                <option value="1">JSHOW</option>
            </field>
        </fieldset>
    </fields>
</form>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.ini}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%d foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%d foo published."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%d foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%d foo unpublished."

COM_FOOS_EDIT_FOO="Edit Foo"
COM_FOOS_NEW_FOO="New Foo"

COM_FOOS_HEADING_ASSOCIATION="Association"
COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"

COM_FOOS_TABLE_CAPTION="Foo Table Caption"

COM_FOOS_N_ITEMS_ARCHIVED="%d foos archived."
COM_FOOS_N_ITEMS_ARCHIVED_1="%d foo archived."
COM_FOOS_N_ITEMS_DELETED="%d foos deleted."
COM_FOOS_N_ITEMS_DELETED_1="%d foo deleted."
COM_FOOS_N_ITEMS_TRASHED="%d foos trashed."
COM_FOOS_N_ITEMS_TRASHED_1="%d foo trashed."
COM_FOO_MANAGER_FOOS="Foos"

COM_FOOS_FIELD_PARAMS_NAME_LABEL="Show Name"
```

### Changing components/com\_foos/View/Foo/HtmlView.php

The `components/com_foos/View/Foo/HtmlView.php` file is ....

#### Completed components/com\_foos/View/Foo/HtmlView.php file

The code for the `components/com_foos/View/Foo/HtmlView.php` file is as
follows:

``` {.php}
<?php
```

### Changing x

The `x` file is ....

#### Completed x file

The code for the `x` file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Site\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

/**
 * HTML Foos View class for the Foo component
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The page parameters
     *
     * @var    \Joomla\Registry\Registry|null
     * @since  1.0.0
     */
    protected $params = null;

    /**
     * The item model state
     *
     * @var    \Joomla\Registry\Registry
     * @since  1.0.0
     */
    protected $state;

    /**
     * The item object details
     *
     * @var    \JObject
     * @since  1.0.0
     */
    protected $item;

    /**
     * Execute and display a template script.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $item = $this->item = $this->get('Item');
        $state = $this->State = $this->get('State');
        $params = $this->Params = $state->get('params');
        $itemparams = new Registry(json_decode($item->params));

        $temp = clone $params;
        $temp->merge($itemparams);
        $item->params = $temp;

        Factory::getApplication()->triggerEvent('onContentPrepare', array ('com_foos.foo', &$item));

        // Store the events for later
        $item->event = new \stdClass;
        $results = Factory::getApplication()->triggerEvent('onContentAfterTitle', array('com_foos.foo', &$item, &$item->params));
        $item->event->afterDisplayTitle = trim(implode("\n", $results));

        $results = Factory::getApplication()->triggerEvent('onContentBeforeDisplay', array('com_foos.foo', &$item, &$item->params));
        $item->event->beforeDisplayContent = trim(implode("\n", $results));

        $results = Factory::getApplication()->triggerEvent('onContentAfterDisplay', array('com_foos.foo', &$item, &$item->params));
        $item->event->afterDisplayContent = trim(implode("\n", $results));

        return parent::display($tpl);
    }
}
```

### Changing components/com\_foos/tmpl/foo/default.php

The `components/com_foos/tmpl/foo/default.php` file is ....

#### Completed components/com\_foos/tmpl/foo/default.php file

The code for the `components/com_foos/tmpl/foo/default.php` file is as
follows:

``` {.php}
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

if ($this->item->params->get('show_name')) {
    if ($this->Params->get('show_foo_name_label')) {
        echo Text::_('COM_FOOS_NAME') . $this->item->name;
    } else {
        echo $this->item->name;
    }
}
echo $this->item->event->afterDisplayTitle; 
echo $this->item->event->beforeDisplayContent;
echo $this->item->event->afterDisplayContent;
```

### Creating administrator/components/com\_foos/sql/updates/mysql/1.18.0.sql

The `administrator/components/com_foos/sql/updates/mysql/1.18.0.sql`
file is ....

#### Completed administrator/components/com\_foos/sql/updates/mysql/1.18.0.sql file

The code for the
`administrator/components/com_foos/sql/updates/mysql/1.18.0.sql` file is
as follows:

``` {.sql}
<?php

ALTER TABLE `#__foos_details` ADD COLUMN  `params` text NOT NULL AFTER `alias`;
```

Test your component
-------------------

Now you can save a parameter of the options separately for each item.

![](as_j4-t_18_1.png "as_j4-t_18_1.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You now have many different ways to save data in a component. In the
next part, we'll look at how you can organize them on different
subpages: Pagination.

geändert: src/administrator/components/com\_foos/View/Foos/HtmlView.php

`   geändert:       src/administrator/components/com_foos/tmpl/foos/default.php`

Adding Pagination - Part 19
===========================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.19.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The pagination object
     *
     * @var  \JPagination
     */
    protected $pagination;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->state->get('filter.category_id'));
        $user  = Factory::getUser();

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOO_MANAGER_FOOS'), 'address foos');

        if ($canDo->get('core.create') || count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0)
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.edit.state'))
        {
            $dropdown = $toolbar->dropdownButton('status-group')
                ->text('JTOOLBAR_CHANGE_STATUS')
                ->toggleSplit(false)
                ->icon('fa fa-globe')
                ->buttonClass('btn btn-info')
                ->listCheck(true);

            $childBar = $dropdown->getChildToolbar();

            $childBar->publish('foos.publish')->listCheck(true);

            $childBar->unpublish('foos.unpublish')->listCheck(true);

            $childBar->archive('foos.archive')->listCheck(true);

            if ($user->authorise('core.admin'))
            {
                $childBar->checkin('foos.checkin')->listCheck(true);
            }

            if ($this->state->get('filter.published') != -2)
            {
                $childBar->trash('foos.trash')->listCheck(true);
            }
        }

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            $toolbar->delete('foos.delete')
                ->text('JTOOLBAR_EMPTY_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->listCheck(true);
        }

        if ($user->authorise('core.admin', 'com_foos') || $user->authorise('core.options', 'com_foos'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Session\Session;

$canChange  = true;
$assoc = Associations::isEnabled();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder && !empty($this->items))
{
    $saveOrderingUrl = 'index.php?option=com_foos&task=foos.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
}
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <caption id="captionTable" class="sr-only">
                            <?php echo Text::_('COM_FOOS_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
                                </th>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_TABLE_TABLEHEAD_NAME', 'a.name', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
                                </th>
                                <?php if ($assoc) : ?>
                                    <th scope="col" style="width:10%">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language_title', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="order text-center d-none d-md-table-cell">
                                    <?php
                                    $iconClass = '';
                                    if (!$canChange)
                                    {
                                        $iconClass = ' inactive';
                                    }
                                    elseif (!$saveOrder)
                                    {
                                        $iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::_('tooltipText', 'JORDERINGDISABLED');
                                    }
                                    ?>
                                    <span class="sortable-handler<?php echo $iconClass; ?>">
                                        <span class="icon-menu" aria-hidden="true"></span>
                                    </span>
                                    <?php if ($canChange && $saveOrder) : ?>
                                        <input type="text" style="display:none" name="order[]" size="5"
                                            value="<?php echo $item->ordering; ?>" class="width-20 text-area-order">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <?php if ($assoc) : ?>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($item->association) : ?>
                                        <?php 
                                        echo HTMLHelper::_('foosadministrator.association', $item->id); 
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <td class="small d-none d-md-table-cell">
                                        <?php echo LayoutHelper::render('joomla.content.language', $item); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php echo $this->pagination->getListFooter(); ?>
                
                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

Test your component
-------------------

Now you see the page numbering in the lower part of the backend and you
can scroll through the pages.

![](as_j4-t_19_1.png "as_j4-t_19_1.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You see a pagination in the lower part of the backend and you can scroll
through the pages. In the next chapter, we'll look at how to make the
layout consistent while also saving lines of code.

Adding a Layout - Part 20
=========================

In this chapter, we'll look at how to make the layout consistent while
also saving lines of code.

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.20.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
        />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
        >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
        >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />

        <field
            name="ordering"
            type="ordering"
            label="JFIELD_ORDERING_LABEL"
            content_type="com_foos.foo"
        />

    </fieldset>
    <fields name="params" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">
        <fieldset name="display" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">

            <field
                name="show_name"
                type="list"
                label="COM_FOOS_FIELD_PARAMS_NAME_LABEL"
                useglobal="true"
            >
                <option value="0">JHIDE</option>
                <option value="1">JSHOW</option>
            </field>

            <field
                name="foos_layout"
                type="componentlayout"
                label="JFIELD_ALT_LAYOUT_LABEL"
                class="custom-select"
                extension="com_foos"
                view="foo"
                useglobal="true"
            />

        </fieldset>
    </fields>
</form>
```

### Changing x

The `x` file is ....

#### Completed x file

The code for the `x` file is as follows:

``` {.xml}
<?php
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.sys.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.sys.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.sys.ini`
file is as follows:

``` {.ini}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_XML_DESCRIPTION="Foo Component"

COM_FOOS_INSTALLERSCRIPT_PREFLIGHT="<p>Anything here happens before the installation/update/uninstallation of the component</p>"
COM_FOOS_INSTALLERSCRIPT_UPDATE="<p>The component has been updated</p>"
COM_FOOS_INSTALLERSCRIPT_UNINSTALL="<p>The component has been uninstalled</p>"
COM_FOOS_INSTALLERSCRIPT_INSTALL="<p>The component has been installed</p>"
COM_FOOS_INSTALLERSCRIPT_POSTFLIGHT="<p>Anything here happens after the installation/update/uninstallation of the component</p>"

COM_FOOS_FOO_VIEW_DEFAULT_TITLE="Single Foo"
COM_FOOS_FOO_VIEW_DEFAULT_DESC="This links to the information for one foo."
COM_FOOS_SELECT_FOO_LABEL="Select a foo"

COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"

COM_FOOS_FOO_VIEW_WITHHEAD_TITLE="Single Foo with a headertext"
COM_FOOS_FOO_VIEW_WITHHEAD_DESC="This links to the information for one foo with a headertext."
```

### Creating components/com\_foos/tmpl/foo/withhead.php

The `components/com_foos/tmpl/foo/withhead.php` file is ....

#### Completed components/com\_foos/tmpl/foo/withhead.php file

The code for the `components/com_foos/tmpl/foo/withhead.php` file is as
follows:

``` {.php}
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

echo "<hr>Here you can show a headertext<hr>";

if ($this->item->params->get('show_name')) {
    if ($this->Params->get('show_foo_name_label')) {
        echo Text::_('COM_FOOS_NAME') . $this->item->name;
    } else {
        echo $this->item->name;
    }
}
echo $this->item->event->afterDisplayTitle; 
echo $this->item->event->beforeDisplayContent;
echo $this->item->event->afterDisplayContent;
```

### Creating components/com\_foos/tmpl/foo/withhead.xml

The `components/com_foos/tmpl/foo/withhead.xml` file is ....

#### Completed components/com\_foos/tmpl/foo/withhead.xml file

The code for the `components/com_foos/tmpl/foo/withhead.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<metadata>
    <layout title="COM_FOOS_FOO_VIEW_WITHHEAD_TITLE">
        <message>
            <![CDATA[COM_FOOS_FOO_VIEW_WITHHEAD_DESC]]>
        </message>
    </layout>
    <!-- Add fields to the request variables for the layout. -->
    <fields name="request">
        <fieldset name="request"
            addfieldprefix="Joomla\Component\Foos\Administrator\Field"
        >
            <field
                name="id"
                type="modal_foo"
                label="COM_FOOS_SELECT_FOO_LABEL"
                required="true"
                select="true"
                new="true"
                edit="true"
                clear="true"
            />
        </fieldset>
    </fields>
</metadata>
```

Test your component
-------------------

Example in Joomla!
------------------

![](componenttutorial20a.png "componenttutorial20a.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Adding Checkout - Part 21
=========================

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.xml}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'catid', 'a.catid', 'category_id', 'category_title',
                'checked_out', 'a.checked_out',
                'checked_out_time', 'a.checked_out_time',
                'published', 'a.published',
                'access', 'a.access', 'access_level',
                'ordering', 'a.ordering',
                'language', 'a.language', 'language_title',
                'publish_up', 'a.publish_up',
                'publish_down', 'a.publish_down',
            );

            $assoc = Associations::isEnabled();

            if ($assoc)
            {
                $config['filter_fields'][] = 'association';
            }
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id AS id,'
                . 'a.name AS name,'
                . 'a.access,'
                . 'a.language,'
                . 'a.ordering AS ordering,'
                . 'a.checked_out AS checked_out,'
                . 'a.checked_out_time AS checked_out_time,'
                . 'a.state AS state,'
                . 'a.catid AS catid,'
                . 'a.published AS published,'
                . 'a.publish_up,'
                . 'a.publish_down'
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.catid',
                            'a.checked_out',
                            'a.checked_out_time',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        // Join over the users for the checked out user.
        $query->select($db->quoteName('uc.name', 'editor'))
            ->join(
                'LEFT',
                $db->quoteName('#__users', 'uc') . ' ON ' . $db->quoteName('uc.id') . ' = ' . $db->quoteName('a.checked_out')
            );

        // Filter by access level.
        if ($access = $this->getState('filter.access'))
        {
            $query->where($db->quoteName('a.access') . ' = ' . (int) $access);
        }

        // Filter by published state
        $published = (string) $this->getState('filter.published');

        if (is_numeric($published))
        {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
        }

        // Filter by a single or group of categories.
        $categoryId = $this->getState('filter.category_id');

        if (is_numeric($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' = ' . (int) $categoryId);
        }
        elseif (is_array($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' IN (' . implode(',', ArrayHelper::toInteger($categoryId)) . ')');
        }

        // Filter by search in name.
        $search = $this->getState('filter.search');

        if (!empty($search))
        {
            if (stripos($search, 'id:') === 0)
            {
                $query->where('a.id = ' . (int) substr($search, 3));
            }
            else
            {
                $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
                $query->where(
                    '(' . $db->quoteName('a.name') . ' LIKE ' . $search . ')'
                );
            }
        }

        // Filter on the language.
        if ($language = $this->getState('filter.language'))
        {
            $query->where($db->quoteName('a.language') . ' = ' . $db->quote($language));
        }

        // Filter by a single tag.
        $tagId = $this->getState('filter.tag');

        if (is_numeric($tagId))
        {
            $query->where($db->quoteName('tagmap.tag_id') . ' = ' . (int) $tagId)
                ->join(
                    'LEFT',
                    $db->quoteName('#__contentitem_tag_map', 'tagmap')
                    . ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('tagmap.type_alias') . ' = ' . $db->quote('com_foos.contact')
                );
        }

        // Filter on the level.
        if ($level = $this->getState('filter.level'))
        {
            $query->where('c.level <= ' . (int) $level);
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        if ($orderCol == 'a.ordering' || $orderCol == 'category_title')
        {
            $orderCol = $db->quoteName('c.title') . ' ' . $orderDirn . ', ' . $db->quoteName('a.ordering');
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        $app = Factory::getApplication();

        $forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

        // Adjust the context to support modal layouts.
        if ($layout = $app->input->get('layout'))
        {
            $this->context .= '.' . $layout;
        }

        // Adjust the context to support forced languages.
        if ($forcedLanguage)
        {
            $this->context .= '.' . $forcedLanguage;
        }

        // List state information.
        parent::populateState($ordering, $direction);

        // Force a language.
        if (!empty($forcedLanguage))
        {
            $this->setState('filter.language', $forcedLanguage);
        }
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.xml}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The pagination object
     *
     * @var  \JPagination
     */
    protected $pagination;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->state->get('filter.category_id'));
        $user  = Factory::getUser();

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOO_MANAGER_FOOS'), 'address foos');

        if ($canDo->get('core.create') || count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0)
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.edit.state'))
        {
            $dropdown = $toolbar->dropdownButton('status-group')
                ->text('JTOOLBAR_CHANGE_STATUS')
                ->toggleSplit(false)
                ->icon('fa fa-globe')
                ->buttonClass('btn btn-info')
                ->listCheck(true);

            $childBar = $dropdown->getChildToolbar();

            $childBar->publish('foos.publish')->listCheck(true);

            $childBar->unpublish('foos.unpublish')->listCheck(true);

            $childBar->archive('foos.archive')->listCheck(true);

            if ($user->authorise('core.admin'))
            {
                $childBar->checkin('foos.checkin')->listCheck(true);
            }

            if ($this->state->get('filter.published') != -2)
            {
                $childBar->trash('foos.trash')->listCheck(true);
            }
        }

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            $toolbar->delete('foos.delete')
                ->text('JTOOLBAR_EMPTY_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->listCheck(true);
        }

        if ($user->authorise('core.admin', 'com_foos') || $user->authorise('core.options', 'com_foos'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.21.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>View</folder>
            <folder>services</folder>
            <folder>tmpl</folder>
            <folder>sql</folder>
            <folder>language</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
        />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
        >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
        >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />

        <field
            name="checked_out"
            type="hidden"
            filter="unset"
        />

        <field
            name="checked_out_time"
            type="hidden"
            filter="unset"
        />

        <field
            name="ordering"
            type="ordering"
            label="JFIELD_ORDERING_LABEL"
            content_type="com_foos.foo"
        />

    </fieldset>
    <fields name="params" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">
        <fieldset name="display" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">

            <field
                name="show_name"
                type="list"
                label="COM_FOOS_FIELD_PARAMS_NAME_LABEL"
                useglobal="true"
            >
                <option value="0">JHIDE</option>
                <option value="1">JSHOW</option>
            </field>

            <field
                name="foos_layout"
                type="componentlayout"
                label="JFIELD_ALT_LAYOUT_LABEL"
                class="custom-select"
                extension="com_foos"
                view="foo"
                useglobal="true"
            />

        </fieldset>
    </fields>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.xml}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Session\Session;

$canChange  = true;
$assoc = Associations::isEnabled();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder && !empty($this->items))
{
    $saveOrderingUrl = 'index.php?option=com_foos&task=foos.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
}
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <caption id="captionTable" class="sr-only">
                            <?php echo Text::_('COM_FOOS_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
                                </th>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_TABLE_TABLEHEAD_NAME', 'a.name', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
                                </th>
                                <?php if ($assoc) : ?>
                                    <th scope="col" style="width:10%">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language_title', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="order text-center d-none d-md-table-cell">
                                    <?php
                                    $iconClass = '';
                                    if (!$canChange)
                                    {
                                        $iconClass = ' inactive';
                                    }
                                    elseif (!$saveOrder)
                                    {
                                        $iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::_('tooltipText', 'JORDERINGDISABLED');
                                    }
                                    ?>
                                    <span class="sortable-handler<?php echo $iconClass; ?>">
                                        <span class="icon-menu" aria-hidden="true"></span>
                                    </span>
                                    <?php if ($canChange && $saveOrder) : ?>
                                        <input type="text" style="display:none" name="order[]" size="5"
                                            value="<?php echo $item->ordering; ?>" class="width-20 text-area-order">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <?php if ($item->checked_out) : ?>
                                        <?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'foos.', true); ?>
                                    <?php endif; ?>
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <?php if ($assoc) : ?>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($item->association) : ?>
                                        <?php 
                                        echo HTMLHelper::_('foosadministrator.association', $item->id); 
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <td class="small d-none d-md-table-cell">
                                        <?php echo LayoutHelper::render('joomla.content.language', $item); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php echo $this->pagination->getListFooter(); ?>
                
                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

### Changing administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini

The
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is ....

#### Completed administrator/components/com\_foos/language/en-GB/en-GB.com\_foos.ini file

The code for the
`administrator/components/com_foos/language/en-GB/en-GB.com_foos.ini`
file is as follows:

``` {.xml}
COM_FOOS="[PROJECT_NAME]"
COM_FOOS_CONFIGURATION="Foo Options"

COM_FOOS_MANAGER_FOO_NEW="New"
COM_FOOS_MANAGER_FOO_EDIT="Edit"
COM_FOOS_MANAGER_FOOS="Foo Manager"

COM_FOOS_TABLE_TABLEHEAD_NAME="Name"
COM_FOOS_TABLE_TABLEHEAD_ID="ID"
COM_FOOS_ERROR_FOO_NOT_FOUND="Foo not found"

COM_FOOS_FIELD_NAME_LABEL="Name"

COM_FOOS_FIELD_FOO_SHOW_CATEGORY_LABEL="Show name label"
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DESC="These settings apply for all foo."
COM_FOOS_FIELD_CONFIG_INDIVIDUAL_FOO_DISPLAY="Foo"

COM_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_N_ITEMS_ARCHIVED="%s foos archived."
COM_FOOS_N_ITEMS_ARCHIVED_1="%s foo archived."
COM_FOOS_N_ITEMS_CHECKED_IN_1="%d foo checked in."
COM_FOOS_N_ITEMS_CHECKED_IN_MORE="%d foos checked in."
COM_FOOS_N_ITEMS_DELETED="%s foos deleted."
COM_FOOS_N_ITEMS_DELETED_1="%s foo deleted."
COM_FOOS_N_ITEMS_FEATURED="%s foos featured."
COM_FOOS_N_ITEMS_FEATURED_1="%s foo featured."
COM_FOOS_N_ITEMS_PUBLISHED="%s foos published."
COM_FOOS_N_ITEMS_PUBLISHED_1="%s foo published."
COM_FOOS_N_ITEMS_TRASHED="%s foos trashed."
COM_FOOS_N_ITEMS_TRASHED_1="%s foo trashed."
COM_FOOS_N_ITEMS_UNFEATURED="%s foos unfeatured."
COM_FOOS_N_ITEMS_UNFEATURED_1="%s foo unfeatured."
COM_FOOS_N_ITEMS_UNPUBLISHED="%s foos unpublished."
COM_FOOS_N_ITEMS_UNPUBLISHED_1="%s foo unpublished."

COM_FOOS_FOOS_FIELD_PUBLISH_DOWN_LABEL="Finish Publishing"
COM_FOOS_FOOS_FIELD_PUBLISH_UP_LABEL="Start Publishing"
COM_FOOS_FOOS_N_ITEMS_ARCHIVED="%s foos archived."
COM_FOOS_FOOS_N_ITEMS_ARCHIVED_1="%s foo archived."
COM_FOOS_FOOS_N_ITEMS_CHECKED_IN_1="%d foo checked in."
COM_FOOS_FOOS_N_ITEMS_CHECKED_IN_MORE="%d foos checked in."
COM_FOOS_FOOS_N_ITEMS_DELETED="%s foos deleted."
COM_FOOS_FOOS_N_ITEMS_DELETED_1="%s foo deleted."
COM_FOOS_FOOS_N_ITEMS_FEATURED="%s foos featured."
COM_FOOS_FOOS_N_ITEMS_FEATURED_1="%s foo featured."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED="%s foos published."
COM_FOOS_FOOS_N_ITEMS_PUBLISHED_1="%s foo published."
COM_FOOS_FOOS_N_ITEMS_TRASHED="%s foos trashed."
COM_FOOS_FOOS_N_ITEMS_TRASHED_1="%s foo trashed."
COM_FOOS_FOOS_N_ITEMS_UNFEATURED="%s foos unfeatured."
COM_FOOS_FOOS_N_ITEMS_UNFEATURED_1="%s foo unfeatured."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED="%s foos unpublished."
COM_FOOS_FOOS_N_ITEMS_UNPUBLISHED_1="%s foo unpublished."

COM_FOOS_EDIT_FOO="Edit Foo"
COM_FOOS_NEW_FOO="New Foo"

COM_FOOS_HEADING_ASSOCIATION="Association"
COM_FOOS_CHANGE_FOO="Change a foo"
COM_FOOS_SELECT_A_FOO="Select a foo"

COM_FOOS_TABLE_CAPTION="Foo Table Caption"

COM_FOOS_N_ITEMS_ARCHIVED="%d foos archived."
COM_FOOS_N_ITEMS_ARCHIVED_1="%d foo archived."
COM_FOOS_N_ITEMS_DELETED="%d foos deleted."
COM_FOOS_N_ITEMS_DELETED_1="%d foo deleted."
COM_FOOS_N_ITEMS_TRASHED="%d foos trashed."
COM_FOOS_N_ITEMS_TRASHED_1="%d foo trashed."
COM_FOO_MANAGER_FOOS="Foos"

COM_FOOS_FIELD_PARAMS_NAME_LABEL="Show Name"
```

### Creating /administrator/components/com\_foos/sql/updates/mysql/1.21.0.sql

The `/administrator/components/com_foos/sql/updates/mysql/1.21.0.sql`
file is ....

#### Completed /administrator/components/com\_foos/sql/updates/mysql/1.21.0.sql file

The code for the
`/administrator/components/com_foos/sql/updates/mysql/1.21.0.sql` file
is as follows:

``` {.sql}
ALTER TABLE `#__foos_details` ADD COLUMN  `checked_out` int(10) unsigned NOT NULL DEFAULT 0 AFTER `alias`;

ALTER TABLE `#__foos_details` ADD COLUMN  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `alias`;
```

Test your component
-------------------

If two users edit an item at the same time, it could lead to overlapping
and thus data loss. Therefore, we block the entry as long as it is being
edited by a user. The sign is the lock.

![](as_j4_t_21_1.png "as_j4_t_21_1.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

In this chapter, we have made sure that the data is processed more
securely. Next, we'll look at how we can edit a lot of data in one fell
swoop.

Adding a batch process and alias - Part 22
==========================================

In this chapter we'll look at how we can edit a lot of data in one fell
swoop.

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/Controller/FooController.php

The `administrator/components/com_foos/Controller/FooController.php`
file is ....

#### Completed administrator/components/com\_foos/Controller/FooController.php file

The code for the
`administrator/components/com_foos/Controller/FooController.php` file is
as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;

/**
 * Controller for a single foo
 *
 * @since  1.0
 */
class FooController extends FormController
{
    /**
     * Method to run batch operations.
     *
     * @param   object  $model  The model.
     *
     * @return  boolean   True if successful, false otherwise and internal error is set.
     *
     * @since   1.0
     */
    public function batch($model = null)
    {
        $this->checkToken();

        $model = $this->getModel('Foo', 'Administrator', array());

        // Preset the redirect
        $this->setRedirect(Route::_('index.php?option=com_foos&view=foos' . $this->getRedirectToListAppend(), false));

        return parent::batch($model);
    }

}
```

### Changing administrator/components/com\_foos/Model/FooModel.php

The `administrator/components/com_foos/Model/FooModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FooModel.php file

The code for the `administrator/components/com_foos/Model/FooModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\LanguageHelper;

/**
 * Item Model for a Foo.
 *
 * @since  1.0
 */
class FooModel extends AdminModel
{
    /**
     * The type alias for this content type.
     *
     * @var    string
     * @since  1.0
     */
    public $typeAlias = 'com_foos.foo';

    /**
     * The context used for the associations table
     *
     * @var    string
     * @since  1.0
     */
    protected $associationsContext = 'com_foos.item';

    /**
     * Batch copy/move command. If set to false, the batch copy/move command is not supported
     *
     * @var  string
     */
    protected $batch_copymove = 'category_id';

    /**
     * Allowed batch commands
     *
     * @var array
     */
    protected $batch_commands = array(
        'assetgroup_id' => 'batchAccess',
        'language_id'   => 'batchLanguage',
    );

    /**
     * Method to get the row form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  \JForm|boolean  A \JForm object on success, false on failure
     *
     * @since   1.0
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form.
        $form = $this->loadForm('com_foos.foo', 'foo', array('control' => 'jform', 'load_data' => $loadData));

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.0
     */
    protected function loadFormData()
    {
        $app = Factory::getApplication();

        $data = $this->getItem();

        $this->preprocessData('com_foos.foo', $data);

        return $data;
    }

    /**
     * Method to get a single record.
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed  Object on success, false on failure.
     *
     * @since   1.0
     */
    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        // Load associated foo items
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $item->associations = array();

            if ($item->id != null)
            {
                $associations = Associations::getAssociations('com_foos', '#__foos_details', 'com_foos.item', $item->id, 'id', null);

                foreach ($associations as $tag => $association)
                {
                    $item->associations[$tag] = $association->id;
                }
            }
        }

        return $item;
    }

    /**
     * Preprocess the form.
     *
     * @param   \JForm  $form   Form object.
     * @param   object  $data   Data object.
     * @param   string  $group  Group name.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function preprocessForm(\JForm $form, $data, $group = 'content')
    {
        if (Associations::isEnabled())
        {
            $languages = LanguageHelper::getContentLanguages(false, true, null, 'ordering', 'asc');

            if (count($languages) > 1)
            {
                $addform = new \SimpleXMLElement('<form />');
                $fields = $addform->addChild('fields');
                $fields->addAttribute('name', 'associations');
                $fieldset = $fields->addChild('fieldset');
                $fieldset->addAttribute('name', 'item_associations');

                foreach ($languages as $language)
                {
                    $field = $fieldset->addChild('field');
                    $field->addAttribute('name', $language->lang_code);
                    $field->addAttribute('type', 'modal_foo');
                    $field->addAttribute('language', $language->lang_code);
                    $field->addAttribute('label', $language->title);
                    $field->addAttribute('translate_label', 'false');
                    $field->addAttribute('select', 'true');
                    $field->addAttribute('new', 'true');
                    $field->addAttribute('edit', 'true');
                    $field->addAttribute('clear', 'true');
                }

                $form->load($addform, false);
            }
        }

        parent::preprocessForm($form, $data, $group);
    }
}
```

### Changing administrator/components/com\_foos/Model/FoosModel.php

The `administrator/components/com_foos/Model/FoosModel.php` file is ....

#### Completed administrator/components/com\_foos/Model/FoosModel.php file

The code for the `administrator/components/com_foos/Model/FoosModel.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * Methods supporting a list of foo records.
 *
 * @since  1.0
 */
class FoosModel extends ListModel
{
    /**
     * Constructor.
     *
     * @param   array  $config  An optional associative array of configuration settings.
     *
     * @see     \JControllerLegacy
     * @since   1.0
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'name', 'a.name',
                'alias', 'a.alias',
                'catid', 'a.catid', 'category_id', 'category_title',
                'checked_out', 'a.checked_out',
                'checked_out_time', 'a.checked_out_time',
                'published', 'a.published',
                'access', 'a.access', 'access_level',
                'ordering', 'a.ordering',
                'language', 'a.language', 'language_title',
                'publish_up', 'a.publish_up',
                'publish_down', 'a.publish_down',
            );

            $assoc = Associations::isEnabled();

            if ($assoc)
            {
                $config['filter_fields'][] = 'association';
            }
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.0
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select',
                'a.id AS id,'
                . 'a.name AS name,'
                . 'a.access,'
                . 'a.language,'
                . 'a.ordering AS ordering,'
                . 'a.checked_out AS checked_out,'
                . 'a.checked_out_time AS checked_out_time,'
                . 'a.state AS state,'
                . 'a.catid AS catid,'
                . 'a.published AS published,'
                . 'a.publish_up,'
                . 'a.publish_down'
            )
        );

        $query->from($db->quoteName('#__foos_details', 'a'));

        // Join over the asset groups.
        $query->select($db->quoteName('ag.title', 'access_level'))
            ->join(
                'LEFT',
                $db->quoteName('#__viewlevels', 'ag') . ' ON ' . $db->quoteName('ag.id') . ' = ' . $db->quoteName('a.access')
            );

        // Join over the categories.
        $query->select($db->quoteName('c.title', 'category_title'))
            ->join(
                'LEFT',
                $db->quoteName('#__categories', 'c') . ' ON ' . $db->quoteName('c.id') . ' = ' . $db->quoteName('a.catid')
            );

        // Join over the language
        $query->select($db->quoteName('l.title', 'language_title'))
            ->select($db->quoteName('l.image', 'language_image'))
            ->join(
                'LEFT',
                $db->quoteName('#__languages', 'l') . ' ON ' . $db->quoteName('l.lang_code') . ' = ' . $db->quoteName('a.language')
            );

        // Join over the associations.
        $assoc = Associations::isEnabled();

        if ($assoc)
        {
            $query->select('COUNT(' . $db->quoteName('asso2.id') . ') > 1 as ' . $db->quoteName('association'))
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso') . ' ON ' . $db->quoteName('asso.id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('asso.context') . ' = ' . $db->quote('com_foos.item')
                )
                ->join(
                    'LEFT',
                    $db->quoteName('#__associations', 'asso2') . ' ON ' . $db->quoteName('asso2.key') . ' = ' . $db->quoteName('asso.key')
                )
                ->group(
                    $db->quoteName(
                        array(
                            'a.id',
                            'a.name',
                            'a.alias',
                            'a.catid',
                            'a.checked_out',
                            'a.checked_out_time',
                            'a.published',
                            'a.access',
                            'a.language',
                            'a.publish_up',
                            'a.publish_down',
                            'l.title' ,
                            'l.image' ,
                            'ag.title' ,
                            'c.title'
                        )
                    )
                );
        }

        // Join over the users for the checked out user.
        $query->select($db->quoteName('uc.name', 'editor'))
            ->join(
                'LEFT',
                $db->quoteName('#__users', 'uc') . ' ON ' . $db->quoteName('uc.id') . ' = ' . $db->quoteName('a.checked_out')
            );

        // Filter by access level.
        if ($access = $this->getState('filter.access'))
        {
            $query->where($db->quoteName('a.access') . ' = ' . (int) $access);
        }

        // Filter by published state
        $published = (string) $this->getState('filter.published');

        if (is_numeric($published))
        {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }
        elseif ($published === '')
        {
            $query->where('(' . $db->quoteName('a.published') . ' = 0 OR ' . $db->quoteName('a.published') . ' = 1)');
        }

        // Filter by a single or group of categories.
        $categoryId = $this->getState('filter.category_id');

        if (is_numeric($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' = ' . (int) $categoryId);
        }
        elseif (is_array($categoryId))
        {
            $query->where($db->quoteName('a.catid') . ' IN (' . implode(',', ArrayHelper::toInteger($categoryId)) . ')');
        }

        // Filter by search in name.
        $search = $this->getState('filter.search');

        if (!empty($search))
        {
            if (stripos($search, 'id:') === 0)
            {
                $query->where('a.id = ' . (int) substr($search, 3));
            }
            else
            {
                $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
                $query->where(
                    '(' . $db->quoteName('a.name') . ' LIKE ' . $search . ')'
                );
            }
        }

        // Filter on the language.
        if ($language = $this->getState('filter.language'))
        {
            $query->where($db->quoteName('a.language') . ' = ' . $db->quote($language));
        }

        // Filter by a single tag.
        $tagId = $this->getState('filter.tag');

        if (is_numeric($tagId))
        {
            $query->where($db->quoteName('tagmap.tag_id') . ' = ' . (int) $tagId)
                ->join(
                    'LEFT',
                    $db->quoteName('#__contentitem_tag_map', 'tagmap')
                    . ' ON ' . $db->quoteName('tagmap.content_item_id') . ' = ' . $db->quoteName('a.id')
                    . ' AND ' . $db->quoteName('tagmap.type_alias') . ' = ' . $db->quote('com_foos.contact')
                );
        }

        // Filter on the level.
        if ($level = $this->getState('filter.level'))
        {
            $query->where('c.level <= ' . (int) $level);
        }

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'a.name');
        $orderDirn = $this->state->get('list.direction', 'asc');

        if ($orderCol == 'a.ordering' || $orderCol == 'category_title')
        {
            $orderCol = $db->quoteName('c.title') . ' ' . $orderDirn . ', ' . $db->quoteName('a.ordering');
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function populateState($ordering = 'a.name', $direction = 'asc')
    {
        $app = Factory::getApplication();

        $forcedLanguage = $app->input->get('forcedLanguage', '', 'cmd');

        // Adjust the context to support modal layouts.
        if ($layout = $app->input->get('layout'))
        {
            $this->context .= '.' . $layout;
        }

        // Adjust the context to support forced languages.
        if ($forcedLanguage)
        {
            $this->context .= '.' . $forcedLanguage;
        }

        // List state information.
        parent::populateState($ordering, $direction);

        // Force a language.
        if (!empty($forcedLanguage))
        {
            $this->setState('filter.language', $forcedLanguage);
        }
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The pagination object
     *
     * @var  \JPagination
     */
    protected $pagination;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->state->get('filter.category_id'));
        $user  = Factory::getUser();

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOO_MANAGER_FOOS'), 'address foos');

        if ($canDo->get('core.create') || count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0)
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.edit.state'))
        {
            $dropdown = $toolbar->dropdownButton('status-group')
                ->text('JTOOLBAR_CHANGE_STATUS')
                ->toggleSplit(false)
                ->icon('fa fa-globe')
                ->buttonClass('btn btn-info')
                ->listCheck(true);

            $childBar = $dropdown->getChildToolbar();

            $childBar->publish('foos.publish')->listCheck(true);

            $childBar->unpublish('foos.unpublish')->listCheck(true);

            $childBar->archive('foos.archive')->listCheck(true);

            if ($user->authorise('core.admin'))
            {
                $childBar->checkin('foos.checkin')->listCheck(true);
            }

            if ($this->state->get('filter.published') != -2)
            {
                $childBar->trash('foos.trash')->listCheck(true);
            }
        }

        $toolbar->popupButton('batch')
            ->text('JTOOLBAR_BATCH')
            ->selector('collapseModal')
            ->listCheck(true);

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            $toolbar->delete('foos.delete')
                ->text('JTOOLBAR_EMPTY_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->listCheck(true);
        }

        if ($user->authorise('core.admin', 'com_foos') || $user->authorise('core.options', 'com_foos'))
        {
            $toolbar->preferences('com_foos');
        }

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.22.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Field</folder>
            <folder>Helper</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>Table</folder>
            <folder>View</folder>
            <folder>forms</folder>
            <folder>language</folder>
            <folder>services</folder>
            <folder>sql</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

### Changing administrator/components/com\_foos/forms/foo.xml

The `administrator/components/com_foos/forms/foo.xml` file is ....

#### Completed administrator/components/com\_foos/forms/foo.xml file

The code for the `administrator/components/com_foos/forms/foo.xml` file
is as follows:

``` {.php}
<?xml version="1.0" encoding="utf-8"?>
<form>
    <fieldset 
        addfieldprefix="Joomla\Component\Foos\Administrator\Field" 
        addruleprefix="Joomla\Component\Foos\Administrator\Rule"
    >
        <field
            name="id"
            type="number"
            label="JGLOBAL_FIELD_ID_LABEL"
            default="0"
            class="readonly"
            readonly="true"
        />

        <field
            name="name"
            type="text"
            validate="Letter"
            class="validate-letter"
            label="COM_FOOS_FIELD_NAME_LABEL"
            size="40"
            required="true"
        />

        <field
            name="alias"
            type="text"
            label="JFIELD_ALIAS_LABEL"
            size="45"
            hint="JFIELD_ALIAS_PLACEHOLDER"
        />

        <field
            name="language"
            type="contentlanguage"
            label="JFIELD_LANGUAGE_LABEL"
        >
            <option value="*">JALL</option>
        </field>

        <field
            name="published"
            type="list"
            label="JSTATUS"
            default="1"
            id="published"
            class="custom-select-color-state"
            size="1"
        >
            <option value="1">JPUBLISHED</option>
            <option value="0">JUNPUBLISHED</option>
            <option value="2">JARCHIVED</option>
            <option value="-2">JTRASHED</option>
        </field>

        <field
            name="publish_up"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_UP_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="publish_down"
            type="calendar"
            label="COM_FOOS_FIELD_PUBLISH_DOWN_LABEL"
            translateformat="true"
            showtime="true"
            size="22"
            filter="user_utc"
        />

        <field
            name="catid"
            type="categoryedit"
            label="JCATEGORY"
            extension="com_foos"
            addfieldprefix="Joomla\Component\Categories\Administrator\Field"
            required="true"
            default=""
        />

        <field
            name="access"
            type="accesslevel"
            label="JFIELD_ACCESS_LABEL"
            size="1"
        />

        <field
            name="checked_out"
            type="hidden"
            filter="unset"
        />

        <field
            name="checked_out_time"
            type="hidden"
            filter="unset"
        />

        <field
            name="ordering"
            type="ordering"
            label="JFIELD_ORDERING_LABEL"
            content_type="com_foos.foo"
        />

    </fieldset>
    <fields name="params" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">
        <fieldset name="display" label="JGLOBAL_FIELDSET_DISPLAY_OPTIONS">

            <field
                name="show_name"
                type="list"
                label="COM_FOOS_FIELD_PARAMS_NAME_LABEL"
                useglobal="true"
            >
                <option value="0">JHIDE</option>
                <option value="1">JSHOW</option>
            </field>

            <field
                name="foos_layout"
                type="componentlayout"
                label="JFIELD_ALT_LAYOUT_LABEL"
                class="custom-select"
                extension="com_foos"
                view="foo"
                useglobal="true"
            />

        </fieldset>
    </fields>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foo/edit.php

The `administrator/components/com_foos/tmpl/foo/edit.php` file is ....

#### Completed administrator/components/com\_foos/tmpl/foo/edit.php file

The code for the `administrator/components/com_foos/tmpl/foo/edit.php`
file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('script', 'com_foos/admin-foos-letter.js', array('version' => 'auto', 'relative' => true));

$app = Factory::getApplication();
$input = $app->input;

$assoc = Associations::isEnabled();

$this->ignore_fieldsets = array('item_associations');
$this->useCoreUI = true;

// In case of modal
$isModal = $input->get('layout') == 'modal' ? true : false;
$layout  = $isModal ? 'modal' : 'edit';
$tmpl    = $isModal || $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
?>

<form action="<?php echo Route::_('index.php?option=com_foos&layout=' . $layout . $tmpl . '&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="foo-form" class="form-validate">

    <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

    <div>
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', empty($this->item->id) ? Text::_('COM_FOOS_NEW_FOO') : Text::_('COM_FOOS_EDIT_FOO')); ?>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo $this->getForm()->renderField('access'); ?>
                        <?php echo $this->getForm()->renderField('published'); ?>
                        <?php echo $this->getForm()->renderField('publish_up'); ?>
                        <?php echo $this->getForm()->renderField('publish_down'); ?>
                        <?php echo $this->getForm()->renderField('catid'); ?>
                        <?php echo $this->getForm()->renderField('language'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php if ( ! $isModal && $assoc) : ?>
            <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'associations', Text::_('JGLOBAL_FIELDSET_ASSOCIATIONS')); ?>
            <?php echo $this->loadTemplate('associations'); ?>
            <?php echo HTMLHelper::_('uitab.endTab'); ?>
        <?php elseif ($isModal && $assoc) : ?>
            <div class="hidden"><?php echo $this->loadTemplate('associations'); ?></div>
        <?php endif; ?>
        
        <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

        <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    </div>

        <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
```

### Changing administrator/components/com\_foos/tmpl/foos/default.php

The `administrator/components/com_foos/tmpl/foos/default.php` file is
....

#### Completed administrator/components/com\_foos/tmpl/foos/default.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default.php` file is as
follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Session\Session;

$canChange  = true;
$assoc = Associations::isEnabled();
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder && !empty($this->items))
{
    $saveOrderingUrl = 'index.php?option=com_foos&task=foos.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
}
?>
<form action="<?php echo Route::_('index.php?option=com_foos'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <?php if (!empty($this->sidebar)) : ?>
            <div id="j-sidebar-container" class="col-md-2">
                <?php echo $this->sidebar; ?>
            </div>
        <?php endif; ?>
        <div class="<?php if (!empty($this->sidebar)) {echo 'col-md-10'; } else { echo 'col-md-12'; } ?>">
            <div id="j-main-container" class="j-main-container">
                <?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-warning">
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                    <table class="table" id="fooList">
                        <caption id="captionTable" class="sr-only">
                            <?php echo Text::_('COM_FOOS_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
                        </caption>
                        <thead>
                            <tr>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
                                </th>
                                <td style="width:1%" class="text-center">
                                    <?php echo HTMLHelper::_('grid.checkall'); ?>
                                </td>
                                <th scope="col" style="width:1%" class="text-center d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_TABLE_TABLEHEAD_NAME', 'a.name', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ACCESS', 'access_level', $listDirn, $listOrder); ?>
                                </th>
                                <?php if ($assoc) : ?>
                                    <th scope="col" style="width:10%">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'COM_FOOS_HEADING_ASSOCIATION', 'association', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <th scope="col" style="width:10%" class="d-none d-md-table-cell">
                                        <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_LANGUAGE', 'language_title', $listDirn, $listOrder); ?>
                                    </th>
                                <?php endif; ?>
                                <th scope="col" style="width:1%; min-width:85px" class="text-center">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                                </th>
                                <th scope="col">
                                    <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $n = count($this->items);
                        foreach ($this->items as $i => $item) :
                            ?>
                            <tr class="row<?php echo $i % 2; ?>">
                                <td class="order text-center d-none d-md-table-cell">
                                    <?php
                                    $iconClass = '';
                                    if (!$canChange)
                                    {
                                        $iconClass = ' inactive';
                                    }
                                    elseif (!$saveOrder)
                                    {
                                        $iconClass = ' inactive tip-top hasTooltip" title="' . HTMLHelper::_('tooltipText', 'JORDERINGDISABLED');
                                    }
                                    ?>
                                    <span class="sortable-handler<?php echo $iconClass; ?>">
                                        <span class="icon-menu" aria-hidden="true"></span>
                                    </span>
                                    <?php if ($canChange && $saveOrder) : ?>
                                        <input type="text" style="display:none" name="order[]" size="5"
                                            value="<?php echo $item->ordering; ?>" class="width-20 text-area-order">
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                                </td>
                                <td scope="row" class="has-context">
                                    <?php if ($item->checked_out) : ?>
                                        <?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'foos.', true); ?>
                                    <?php endif; ?>
                                    <div>
                                        <?php echo $this->escape($item->name); ?>
                                    </div>
                                    <?php $editIcon = '<span class="fa fa-pencil-square mr-2" aria-hidden="true"></span>'; ?>
                                    <a class="hasTooltip" href="<?php echo Route::_('index.php?option=com_foos&task=foo.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape(addslashes($item->name)); ?>">
                                        <?php echo $editIcon; ?><?php echo $this->escape($item->name); ?>
                                    </a>
                                    <div class="small">
                                        <?php echo Text::_('JCATEGORY') . ': ' . $this->escape($item->category_title); ?>
                                    </div>

                                </td>
                                <td class="small d-none d-md-table-cell">
                                    <?php echo $item->access_level; ?>
                                </td>
                                <?php if ($assoc) : ?>
                                <td class="d-none d-md-table-cell">
                                    <?php if ($item->association) : ?>
                                        <?php 
                                        echo HTMLHelper::_('foosadministrator.association', $item->id); 
                                        ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if (Multilanguage::isEnabled()) : ?>
                                    <td class="small d-none d-md-table-cell">
                                        <?php echo LayoutHelper::render('joomla.content.language', $item); ?>
                                    </td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'foos.', $canChange, 'cb', $item->publish_up, $item->publish_down); ?>
                                    </div>  
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <?php echo $item->id; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php echo $this->pagination->getListFooter(); ?>
                
                    <?php echo HTMLHelper::_(
                        'bootstrap.renderModal',
                        'collapseModal',
                        array(
                            'title'  => Text::_('COM_FOOS_BATCH_OPTIONS'),
                            'footer' => $this->loadTemplate('batch_footer'),
                        ),
                        $this->loadTemplate('batch_body')
                    ); ?>

                <?php endif; ?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>
```

### Creating administrator/components/com\_foos/tmpl/foos/default\_batch.php

The `administrator/components/com_foos/tmpl/foos/default_batch.php` file
is the installation file.

#### Completed administrator/components/com\_foos/tmpl/foos/default\_batch.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default_batch.php` file is
as follows:

``` {.xml}
<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$published = $this->state->get('filter.published');
$noUser = true;
?>
<div class="modal hide fade" id="collapseModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&#215;</button>
        <h3><?php echo Text::_('COM_FOOS_BATCH_OPTIONS'); ?></h3>
    </div>
    <div class="modal-body modal-batch">
        <p><?php echo Text::_('COM_FOOS_BATCH_TIP'); ?></p>
        <div class="row">
            <div class="form-group col-md-6">
                <div class="controls">
                    <?php echo LayoutHelper::render('joomla.html.batch.language', []); ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="controls">
                    <?php echo LayoutHelper::render('joomla.html.batch.access', []); ?>
                </div>
            </div>
        </div>
        <div class="row">
        <?php if ($published >= 0) : ?>
            <div class="form-group col-md-6">
                <div class="controls">
                    <?php echo LayoutHelper::render('joomla.html.batch.item', ['extension' => 'com_foos']); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="form-group col-md-6">
            <div class="controls">
                <?php echo LayoutHelper::render('joomla.html.batch.tag', []); ?>
            </div>
        </div>
        <div class="row">
            <div class="control-group">
                <div class="controls">
                    <?php echo LayoutHelper::render('joomla.html.batch.user', ['noUser' => $noUser]); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value='';document.getElementById('batch-user-id').value='';document.getElementById('batch-tag-id').value=''" data-dismiss="modal">
            <?php echo Text::_('JCANCEL'); ?>
        </button>
        <button class="btn btn-primary" type="submit" onclick="Joomla.submitbutton('foo.batch');">
            <?php echo Text::_('JGLOBAL_BATCH_PROCESS'); ?>
        </button>
    </div>
</div>
```

### Creating administrator/components/com\_foos/tmpl/foos/default\_batch\_body.php

The `administrator/components/com_foos/tmpl/foos/default_batch_body.php`
file is the installation file.

#### Completed administrator/components/com\_foos/tmpl/foos/default\_batch\_body.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default_batch_body.php`
file is as follows:

``` {.xml}
<?php
defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;

$published = $this->state->get('filter.published');
$noUser    = true;
?>

<div class="container">
    <div class="row">
        <div class="form-group col-md-6">
            <div class="controls">
                <?php echo LayoutHelper::render('joomla.html.batch.language', []); ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="controls">
                <?php echo LayoutHelper::render('joomla.html.batch.access', []); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if ($published >= 0) : ?>
            <div class="form-group col-md-6">
                <div class="controls">
                    <?php echo LayoutHelper::render('joomla.html.batch.item', ['extension' => 'com_foos']); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
```

### Creating administrator/components/com\_foos/tmpl/foos/default\_batch\_footer.php

The
`administrator/components/com_foos/tmpl/foos/default_batch_footer.php`
file is the installation file.

#### Completed administrator/components/com\_foos/tmpl/foos/default\_batch\_footer.php file

The code for the
`administrator/components/com_foos/tmpl/foos/default_batch_footer.php`
file is as follows:

``` {.xml}
<?php
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<button type="button" class="btn btn-secondary" onclick="document.getElementById('batch-category-id').value='';document.getElementById('batch-access').value='';document.getElementById('batch-language-id').value='';document.getElementById('batch-user-id').value='';document.getElementById('batch-tag-id').value=''" data-dismiss="modal">
    <?php echo Text::_('JCANCEL'); ?>
</button>
<button type="submit" class="btn btn-success" onclick="Joomla.submitbutton('foo.batch');">
    <?php echo Text::_('JGLOBAL_BATCH_PROCESS'); ?>
</button>
```

Test your component
-------------------

![](as_j4_t_22_1.png "as_j4_t_22_1.png"){width="700"}

![](as_j4_t_22_2.png "as_j4_t_22_2.png"){width="700"}

Example in Joomla!
------------------

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Well, you have many different features built into your component.
Perhaps you would like to explain these functions to your users with a
help page? This is the topic of the next chapter.

Adding a help link - Part 23
============================

Well, you have many different features built into your component.
Perhaps you would like to explain these functions to your users with a
help page? This is the topic of this chapter

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/View/Foo/HtmlView.php

The `administrator/components/com_foos/View/Foo/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foo/HtmlView.php file

The code for the file is as follows:

``` {.php}
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foo;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * View to edit a foo.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * The \JForm object
     *
     * @var  \JForm
     */
    protected $form;

    /**
     * The active item
     *
     * @var  object
     */
    protected $item;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->item = $this->get('Item');

        // If we are forcing a language in modal (used for associations).
        if ($this->getLayout() === 'modal' && $forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'cmd'))
        {
            // Set the language field to the forcedLanguage and disable changing it.
            $this->form->setValue('language', null, $forcedLanguage);
            $this->form->setFieldAttribute('language', 'readonly', 'true');

            // Only allow to select categories with All language or with the forced language.
            $this->form->setFieldAttribute('catid', 'language', '*,' . $forcedLanguage);
        }

        $this->addToolbar();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        Factory::getApplication()->input->set('hidemainmenu', true);

        $user  = Factory::getUser();
        $userId = $user->id;
        $isNew = ($this->item->id == 0);
        $test = $user->getAuthorisedCategories('com_foos', 'core.create');

        ToolbarHelper::title($isNew ? Text::_('COM_FOOS_MANAGER_FOO_NEW') : Text::_('COM_FOOS_MANAGER_FOO_EDIT'), 'address foo');

        // Since we don't track these assets at the item level, use the category id.
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->item->catid);

        // Build the actions for new and existing records.
        if ($isNew)
        {
            // For new records, check the create permission.
            if ((count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0))
            {
                ToolbarHelper::apply('foo.apply');

                ToolbarHelper::saveGroup(
                    [
                        ['save', 'foo.save'],
                        ['save2new', 'foo.save2new']
                    ],
                    'btn-success'
                );
            }

            ToolbarHelper::cancel('foo.cancel');
        }
        else
        {
            // Since it's an existing record, check the edit permission, or fall back to edit own if the owner.
            $itemEditable = $canDo->get('core.edit') || ($canDo->get('core.edit.own') && $this->item->created_by == $userId);

            $toolbarButtons = [];

            // Can't save the record if it's not editable
            if ($itemEditable)
            {
                ToolbarHelper::apply('foo.apply');

                $toolbarButtons[] = ['save', 'foo.save'];

                // We can save this record, but check the create permission to see if we can return to make a new one.
                if ($canDo->get('core.create'))
                {
                    $toolbarButtons[] = ['save2new', 'foo.save2new'];
                }
            }

            // If checked out, we can still save
            if ($canDo->get('core.create'))
            {
                $toolbarButtons[] = ['save2copy', 'foo.save2copy'];
            }

            ToolbarHelper::saveGroup(
                $toolbarButtons,
                'btn-success'
            );

            if (Associations::isEnabled() && ComponentHelper::isEnabled('com_associations'))
            {
                ToolbarHelper::custom('foo.editAssociations', 'contract', 'contract', 'JTOOLBAR_ASSOCIATIONS', false, false);
            }

            ToolbarHelper::cancel('foo.cancel', 'JTOOLBAR_CLOSE');
        }

        ToolbarHelper::divider();
        ToolbarHelper::help('', false, 'http://google.de');
    }
}
```

### Changing administrator/components/com\_foos/View/Foos/HtmlView.php

The `administrator/components/com_foos/View/Foos/HtmlView.php` file is
....

#### Completed administrator/components/com\_foos/View/Foos/HtmlView.php file

The code for the
`administrator/components/com_foos/View/Foos/HtmlView.php` file is as
follows:

``` {.php}
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_foos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Foos\Administrator\View\Foos;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\Component\Foos\Administrator\Helper\FooHelper;
use Joomla\CMS\Language\Multilanguage;

/**
 * View class for a list of foos.
 *
 * @since  1.0
 */
class HtmlView extends BaseHtmlView
{
    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The pagination object
     *
     * @var  \JPagination
     */
    protected $pagination;

    /**
     * The model state
     *
     * @var  \JObject
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  \JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;

    /**
     * Display the view.
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->filterForm = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state = $this->get('State');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            throw new \JViewGenericdataexception(implode("\n", $errors), 500);
        }

        // Preprocess the list of items to find ordering divisions.
        // TODO: Complete the ordering stuff with nested sets
        foreach ($this->items as &$item)
        {
            $item->order_up = true;
            $item->order_dn = true;
        }

        // We don't need toolbar in the modal window.
        if ($this->getLayout() !== 'modal')
        {
            FooHelper::addSubmenu('foos');
            $this->addToolbar();
            $this->sidebar = \JHtmlSidebar::render();

            // We do not need to filter by language when multilingual is disabled
            if (!Multilanguage::isEnabled())
            {
                unset($this->activeFilters['language']);
                $this->filterForm->removeField('language', 'filter');
            }
        }
        else
        {
            // In article associations modal we need to remove language filter if forcing a language.
            // We also need to change the category filter to show show categories with All or the forced language.
            if ($forcedLanguage = Factory::getApplication()->input->get('forcedLanguage', '', 'CMD'))
            {
                // If the language is forced we can't allow to select the language, so transform the language selector filter into a hidden field.
                $languageXml = new \SimpleXMLElement('<field name="language" type="hidden" default="' . $forcedLanguage . '" />');
                $this->filterForm->setField($languageXml, 'filter', true);

                // Also, unset the active language filter so the search tools is not open by default with this filter.
                unset($this->activeFilters['language']);

                // One last changes needed is to change the category filter to just show categories with All language or with the forced language.
                $this->filterForm->setFieldAttribute('category_id', 'language', '*,' . $forcedLanguage, 'filter');
            }
        }

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.0
     */
    protected function addToolbar()
    {
        $canDo = ContentHelper::getActions('com_foos', 'category', $this->state->get('filter.category_id'));
        $user  = Factory::getUser();

        // Get the toolbar object instance
        $toolbar = Toolbar::getInstance('toolbar');

        ToolbarHelper::title(Text::_('COM_FOO_MANAGER_FOOS'), 'address foos');

        if ($canDo->get('core.create') || count($user->getAuthorisedCategories('com_foos', 'core.create')) > 0)
        {
            $toolbar->addNew('foo.add');
        }

        if ($canDo->get('core.edit.state'))
        {
            $dropdown = $toolbar->dropdownButton('status-group')
                ->text('JTOOLBAR_CHANGE_STATUS')
                ->toggleSplit(false)
                ->icon('fa fa-globe')
                ->buttonClass('btn btn-info')
                ->listCheck(true);

            $childBar = $dropdown->getChildToolbar();

            $childBar->publish('foos.publish')->listCheck(true);

            $childBar->unpublish('foos.unpublish')->listCheck(true);

            $childBar->archive('foos.archive')->listCheck(true);

            if ($user->authorise('core.admin'))
            {
                $childBar->checkin('foos.checkin')->listCheck(true);
            }

            if ($this->state->get('filter.published') != -2)
            {
                $childBar->trash('foos.trash')->listCheck(true);
            }
        }

        $toolbar->popupButton('batch')
            ->text('JTOOLBAR_BATCH')
            ->selector('collapseModal')
            ->listCheck(true);

        if ($this->state->get('filter.published') == -2 && $canDo->get('core.delete'))
        {
            $toolbar->delete('foos.delete')
                ->text('JTOOLBAR_EMPTY_TRASH')
                ->message('JGLOBAL_CONFIRM_DELETE')
                ->listCheck(true);
        }

        if ($user->authorise('core.admin', 'com_foos') || $user->authorise('core.options', 'com_foos'))
        {
            $toolbar->preferences('com_foos');
        }

        ToolbarHelper::divider();
        ToolbarHelper::help('', false, 'http://google.de');

        HTMLHelper::_('sidebar.setAction', 'index.php?option=com_foos');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   1.0
     */
    protected function getSortFields()
    {
        return array(
            'a.ordering'     => Text::_('JGRID_HEADING_ORDERING'),
            'a.published'    => Text::_('JSTATUS'),
            'a.name'         => Text::_('JGLOBAL_TITLE'),
            'category_title' => Text::_('JCATEGORY'),
            'a.access'       => Text::_('JGRID_HEADING_ACCESS'),
            'a.language'     => Text::_('JGRID_HEADING_LANGUAGE'),
            'a.id'           => Text::_('JGRID_HEADING_ID'),
        );
    }
}
```

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.23.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Field</folder>
            <folder>Helper</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>Table</folder>
            <folder>View</folder>
            <folder>forms</folder>
            <folder>language</folder>
            <folder>services</folder>
            <folder>sql</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
</extension>
```

Test your component
-------------------

Example in Joomla!
------------------

You can now individually offer a help page via the button on the top
right. You can put these on the web and keep them up to date. Here I
have chosen google.de as an example. Of course, you can adapt this page
to your circumstances.

![](as_j4_t_23_1.png "as_j4_t_23_1.png"){width="700"}

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

You now know how to keep your users up to date. In the next chapter,
we'll look at how you can make it easy for your users to keep your
extension up-to-date.

Adding an update server and a changelog- Part 24
================================================

In this chapter, we'll look at how you can make it easy for your users
to keep your extension up-to-date.

Requirements
------------

You need Joomla! 4.x for this tutorial (as of writing currently Joomla!
4.0.0-alpha11-dev)

File Structure
--------------

### Changing administrator/components/com\_foos/foos.xml

The `administrator/components/com_foos/foos.xml` file is ....

#### Completed administrator/components/com\_foos/foos.xml file

The code for the `administrator/components/com_foos/foos.xml` file is as
follows:

``` {.xml}
<?xml version="1.0" encoding="utf-8" ?>
<extension type="component" method="upgrade">
    <name>COM_FOOS</name>
    <creationDate>[DATE]</creationDate>
    <author>[AUTHOR]</author>
    <authorEmail>[AUTHOR_EMAIL]</authorEmail>
    <authorUrl>[AUTHOR_URL]</authorUrl>
    <copyright>[COPYRIGHT]</copyright>
    <license>GNU General Public License version 2 or later;</license>
    <version>1.24.0</version>
    <description>COM_FOOS_XML_DESCRIPTION</description>
    <namespace>Joomla\Component\Foos</namespace>
    <scriptfile>script.php</scriptfile>
    <install> <!-- Runs on install -->
        <sql>
            <file driver="mysql" charset="utf8">sql/install.mysql.utf8.sql</file>
        </sql>
    </install>
    <uninstall> <!-- Runs on uninstall -->
        <sql>
            <file driver="mysql" charset="utf8">sql/uninstall.mysql.utf8.sql</file>
        </sql>
    </uninstall>
    <update>  <!-- Runs on update -->
        <schemas>
            <schemapath type="mysql">sql/updates/mysql</schemapath>
        </schemas>
    </update>
    <!-- Frond-end files -->
    <files folder="components/com_foos">
        <folder>Controller</folder>
        <folder>Model</folder>
        <folder>View</folder>
        <folder>tmpl</folder>
        <folder>language</folder>
    </files>
    <media folder="media/com_foos" destination="com_foos">
        <folder>js</folder>
    </media>
    <!-- Back-end files -->
    <administration>
        <!-- Menu entries -->
        <menu view="foos">COM_FOOS</menu>
        <submenu>
            <menu link="option=com_foos">COM_FOOS</menu>
            <menu link="option=com_categories&amp;extension=com_foos"
                view="categories" img="class:foos-cat" alt="Foos/Categories">JCATEGORY</menu>
        </submenu>
        <files folder="administrator/components/com_foos">
            <filename>access.xml</filename>
            <filename>config.xml</filename>
            <filename>foos.xml</filename>
            <folder>Controller</folder>
            <folder>Extension</folder>
            <folder>Field</folder>
            <folder>Helper</folder>
            <folder>Model</folder>
            <folder>Rule</folder>
            <folder>Rule</folder>
            <folder>Service</folder>
            <folder>Table</folder>
            <folder>View</folder>
            <folder>forms</folder>
            <folder>language</folder>
            <folder>services</folder>
            <folder>sql</folder>
            <folder>tmpl</folder>
        </files>
    </administration>
    <changelogurl>https://example.com/.../changelog.xml</changelogurl>
    <updateservers>
        <server type="extension" name="Foo Updates">http://example.com/.../foo_update.xml</server>
    </updateservers>
</extension>
```

### Creating administrator/components/com\_foos/changelog.xml

The `administrator/components/com_foos/changelog.xml` file is the
installation file.

#### Completed administrator/components/com\_foos/changelog.xml file

The code for the `administrator/components/com_foos/changelog.xml` file
is as follows:

``` {.xml}
<changelogs>
    <changelog>
        <element>com_foos</element>
        <type>component</type>
        <version>1.0.0</version>
        <note>
            <item>Initial</item>
        </note>
    </changelog>
    <changelog>
        <element>com_foos</element>
        <type>component</type>
        <version>1.0.0</version>
        <note>
            <item>Add front end view</item>
        </note>
    </changelog>
    <changelog>
        <element>com_foos</element>
        <type>component</type>
        <version>1.24.0</version>
        <security>
            <item>Item A</item>
            <item><![CDATA[<h2>You MUST replace this file</h2>]]></item>
        </security>
        <fix>
            <item>Item A</item>
            <item>Item b</item>
        </fix>
        <language>
            <item>Item A</item>
            <item>Item b</item>
        </language>
        <addition>
            <item>Item A</item>
            <item>Item b</item>
        </addition>
        <change>
            <item>Item A</item>
            <item>Item b</item>
        </change>
        <remove>
            <item>Item A</item>
            <item>Item b</item>
        </remove>
        <note>
            <item>Item A</item>
            <item>Item b</item>
        </note>
    </changelog>
</changelogs>
```

### Creating administrator/components/com\_foos/foo\_update.xml

The `administrator/components/com_foos/foo_update.xml` file is the
installation file.

#### Completed administrator/components/com\_foos/foo\_update.xml file

The code for the `administrator/components/com_foos/foo_update.xml` file
is as follows:

``` {.xml}
<updates>
    <update>
        <name>Foo</name>
        <description>This is com_foo 1.24.0</description>
        <element>com_foo</element>
        <type>component</type>
        <version>1.0.1</version>
        <downloads>
            <downloadurl type="full" format="zip">http://www.example.com/com_foo_101.zip</downloadurl>
        </downloads>
        <maintainer>Foo Creator</maintainer>
        <maintainerurl>http://www.example.com</maintainerurl>
        <targetplatform name="joomla" version="4.0"/>
        <client>site</client>
        <php_minimum>7.1</php_minimum>
    </update>
</updates>
```

Test your component
-------------------

![](componenttutorial24atest.png "componenttutorial24atest.png"){width="700"}

Example in Joomla!
------------------

More informations
-----------------

<https://docs.joomla.org/Adding_changelog_to_your_manifest_file>
<https://github.com/joomla/joomla-cms/pull/24026>

Component Contents
------------------

At this point in the tutorial, your component should contain the
following files:

  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------
  1   administrator/components/com\_foos/Controller/DisplayController.php        this is the administrator entry point to the Foo component                                                                                                                            unchanged
  1   administrator/components/com\_foos/Extension/FoosComponent.php             the interface BootableExtensionInterface where a component class can load its internal class loader or register HTML services see <https://github.com/joomla/joomla-cms/pull/20217>   unchanged
  6   administrator/components/com\_foos/Model/FoosModel.php                     this is the model of the Foo component                                                                                                                                                new
  1   administrator/components/com\_foos/Service/HTML/AdministratorService.php   the html service see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                                unchanged
  1   administrator/components/com\_foos/View/Foos/HtmlView.php                  file representing the view in the back end                                                                                                                                            changed
  1   administrator/components/com\_foos/services/provider.php                   the service provider interface see <https://github.com/joomla/joomla-cms/pull/20217>                                                                                                  changed
  6   administrator/components/com\_foos/sql/install.mysql.utf8.sql              During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  6   administrator/components/com\_foos/sql/uninstall.mysql.utf8.sql            During the install/uninstall/update phase of a component, you can execute SQL queries through the use of this SQL text file                                                           new
  1   administrator/components/com\_foos/tmpl/foos/default.php                   the default view in the back end                                                                                                                                                      changed
  1   administrator/components/com\_foos/foos.xml                                this is an XML (manifest) file that tells Joomla! how to install our component.                                                                                                       changed
  1   administrator/components/com\_foos/script.php                              the installer script                                                                                                                                                                  unchanged
  2   components/com\_foos/Controller/DisplayController.php                      this is the frond end entry point to the Foo component                                                                                                                                unchanged
  4   components/com\_foos/Model/FooModel.php                                    this is the frond end model for the Foo component                                                                                                                                     unchanged
  2   components/com\_foos/View/Foo/HtmlView.php                                 file representing the view in the frond end                                                                                                                                           unchanged
  2   components/com\_foos/tmpl/foo/default.php                                  the default view in the frond end                                                                                                                                                     unchanged
  3   components/com\_foos/tmpl/foo/default.xml                                  the xml for the menu item                                                                                                                                                             unchanged
  --- -------------------------------------------------------------------------- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -----------

Conclusion
----------

Adding Adding frontend edit - Part 25
=====================================

<https://github.com/joomla/joomla-cms/pull/24311>

Adding Tags - Part 26
=====================

<https://github.com/joomla/joomla-cms/issues/23589>

Adding Workflow - Part 27
=========================

I am not sure if we can use it in a third party component.