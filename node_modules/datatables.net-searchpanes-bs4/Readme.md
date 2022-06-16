# SearchPanes

The SearchPanes extension for DataTables provides improved Searching functionality allowing users to select options from a "Pane" which will then in turn search the DataTable and return the relevant results. There are multiple configuration options available to enhance SearchPanes.

# Installation

The SearchPanes extension is available on the [DataTables CDN](https://cdn.datatables.net/#SearchPanes) and in the [download builder](/download). See the [documentation](http://datatables.net/extensions/searchpanes/) for full details.

# NPM

You can also install it from [NPM](/download/npm/#SearchPanes)

If you prefer to use a package manager such as NPM or Bower, distribution repositories are available with software built from this repository under the name `datatables.net-searchpanes. Styling packages for Bootstrap, Foundation and other styling libraries are also available by adding a suffix to the package name.

Please see the DataTables [NPM](//datatables.net/download/npm) installation page for further information. The [DataTables installation manual](//datatables.net/manual/installation) also has details on how to use package managers with DataTables.

# Basic Usage

SearchPanes is initialised by placing a `P` into the DataTables [`dom`](https://datatables.net/reference/option/dom) option. Further options can be specified using this option as an object - see the documentation for details. For example:

```js
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Pfrtip'
    });
});
```

# Documentation / Support

* [Documentation](https://datatables.net/extensions/searchpanes/)
* [DataTables support forums](http://datatables.net/forums)

# GitHub

If you fancy getting involved with the development of SearchPanes and help make it better, please refer to its [GitHub repo](https://github.com/DataTables/SearchPanes)

