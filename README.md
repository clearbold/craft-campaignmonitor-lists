# Campaign Monitor Lists

## Installation

Campaign Monitor Lists allows you to view the latest stats and subscribers for your Campaign Monitor lists. More features to come, including list management features!

To install:

```
composer require clearbold/craft-campaignmonitor-lists
```

## Usage

To use:

After installing and enabling the plugin, you'll need to enter your **API Key** and **Client ID** from your Campaign Monitor account under *Settings > Campaign Monitor Service*.

After doing so, you can navigate to *Campaign Monitor Lists* in your control panel's sidebar to view your stats. Note that data is fetched in real time; response time is based on Campaign Monitor's API.

### Subscribe Form

You can implement a subscribe form in your templates using the following code. Note that **Resubscribe** will be set to **true**.

```
    <form method="post" action="" accept-charset="UTF-8">

      {{ csrfInput() }}
      <input type="hidden" name="action" value="cm-lists/subscribe" />
      <input type="hidden" name="redirect" value="{{ 'foo/bar'|hash }}" />
      <input type="hidden" name="listId" value="{{ 'aaaaallllliiiiissssstttttiiiiiddddd'|hash }}" />

      <label>Email Address</label>
      <input type="email" name="email" placeholder="joe.bloggs@email.com" />

      {# Use firstname + lastname fields, or fullname #}
      <label>First Name</label>
      <input type="text" name="firstname" placeholder="Joe" />

      <label>Last Name</label>
      <input type="text" name="lastname" placeholder="Bloggs" />

      {# <label>Full Name</label>
      <input type="text" name="fullname" placeholder="Joe Bloggs" /> #}

      <label>Custom Field</label>
      <input type="text" name="fields[CustomFieldCampaignMonitor]" placeholder="Some Value" value="Some Value" />

      <input type="submit" value="Subscribe" />

    </form>
```

### Roadmap

* Review and support additional Craft fieldtypes in the subscribe form.
* Review and support additional Campaign Monitor fieldtypes (Number, Radio (Multi-One), Checklist (Multi-Many), Date, Country, US States)