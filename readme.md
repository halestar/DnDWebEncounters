# Combat Encounter Tracker for D&amp;D Tutorial
## Introduction
**What is this app for?** This is a tool to help DMs run encounters. This tool was build for Dungeons & Dragons 5th edition, using monsters and spells from that edition.

**What this is not for.** This is not an app to manage all aspects of encounters. Nor is it an information-heavy app that allows you track all encounter variables. Rather this was built with the idea that it should be as lightweight as possible, aiding the DM in the encounter by entering the least possible amount of data. This app is sued to track the following information on each encounter:

- Encounter Initiative
- Monster Tokens
- Monster HPs
- Turn flow

It also has some simple tools to aid in looking up information, such as a simple spell lookup. All of these tools are made with the idea that the DM already has a lot to track, so it should avoid tracking unnecessary data for it's own sake.

## Your Dashboard

When you first login to Combat Encounter Tracker for D&amp;D, you will see your Dashboard.  From here you can access all the data that needs to be entered in order to begin your encounter, as well as actually begin an encounter.  Before you can start running encounters, however, you will need to enter some basic data. Your Dashboard (as seen below) has 3 different areas: The Inventory, the Main Menu and the On-Going adventures.

![Your Dashboard](https://www.dndencounters.net/img/tutorial/dashboard.png)

## Inventory

Listed here will be a summary of all the information that you have entered into the system in order to run an encounter.  Only a of these items are necessary to begin playing an adventure, while the others are there as extra resources.  To the right of each item will be a number of entries for that item.  For example, a number "4" next to the Players items will mean that you have entered 4 Players into your system.  If you see a red alert below an item, it means that you will need to enter at least one of that particular item.  The items are as follows:

**Players**

Number of real-life players entered.  This will keep basic information, such as name, DCI and an optional picture so that you
can refer to whose turn it is visually.  Some players are weary of getting their pictures taken, so ask for their consent before
you do! A portrait is optional.

**PC's**

Number of **Player Characters** (PC's) entered.  A PC is the actual Character that a Player plays.  Each PC
is attached to a Player, which can have multiple PC's in their repertoire (since they can, and usually do, play a multitude
of characters).  Once again, only the basic information is entered, such as Race, Class, Level, AC, Spell DC (if a caster) and
Max Hit Points.  This is used as a reference for the DM to make the appropriate rolls.
                
**Custom Monsters**

Currently, this app comes included with every SR (Standard Ruleset) Monster available in the Player's Manual.  However,
this is not even half of all the Monsters available for D&amp;D.  Other resource books, such as "Volo's Guide to Monsters", or
"Mordenkainen's Tome of Foes" list whole slew of other monsters.  Individual modules (such as ones purchased from the DM's Guild)
usually also have a list of monsters that have altered stats that fit with the adventure.  Due to copyright issues, the only monsters
available standard through the app are the SR Monsters.  However, you can enter any other monsters from any sources (so long as you own them)
by entering them as Custom Monsters.  This entry denotes how many such monsters you have entered.

**Monster Tokens**

In a lot of cases, D&;D is played using mini's or other tokens on a map.  Players usually bring their own, custom minis, and are responsible
for their own.  However, he DM usually needs to have one mini per monster on the encounter.  And each mini needs to be kept track of, since they
represent a monster in the encounter.  To help with this, you can enter Monster Tokens to denote your minis, tokens, etc.  Each Monster Token
can then be assigned to a real monster during an encounter, and the app will keep track of health, initiative, and all other variables
needed to run the encounter.

**Modules**

A lot of times, encounters can be bundled into Modules.  The idea is to keep certain encounter "together" by bundling them into a module
that can be played by a Party.  This represents the number of Modules you have created.

**Encounters**

An Encounter is a set of Monsters, both SR and Custom, that will appear in a Combat Encounter Tracker for D&amp;D.  Most modules have encounters listed, which you can define
ahead of time in this section.  Once created, this encounter can be used over and over again in different adventures, or for different Parties.

## Main Navigation Menu

This menu is used as the primary way to navigate entering information for the App.  Each section will roughly correspond to a section on the Inventory.
Each section is describe in detail below.

### Player Menu

This section will list all the players and the information that you have entered.  Once information is entered it will look something like this:

![Player list](https://www.dndencounters.net/img/tutorial/players.png)

The Add Icon at the top is used to enter new Players.  Entering a new player will require only the player name, although
you have the ability to also enter the DCI number of that player (for reference) and a portrait.  The add section will look like:

![Adding a new player](https://www.dndencounters.net/img/tutorial/player_add.png)

The only information required for a player is the name.  Both the DCI number and the portrait are optional.  If neither is entered, the DCI will come
up blank, and the portrait will have a placeholder instead.  All portraits are resized and cropped to be 64x64 pixels, in order to save on bandwidth
and storage space.

From the list of players you have a small control panel to the right of each player.  The first icon Edit Icon
will allow you to update your player information.  The Trash Icon will allow you to delete the player entry.  **Deleting
the player entry will also delete all the PC's associated with that player**, so be careful about deleting.  Finally, the Eye Icon
icon will take you to the PC screen, filtering out all PC's so that only the PC's belonging to this player come up.


### PC's Menu

This section will list all the PC's entered into the system.  Once information is entered it will look something like this:

![PC list](https://www.dndencounters.net/img/tutorial/pcs.png)

The Edit Icon at the top is used to enter new PC, while the filtering dropdown will contain a list of all the Players in your system.  Selecting a player from the dropdown will filter the list so that only PC's attached to that Player appear.  Adding a new PC will take you to the
the section to add a new PC:

![Adding a new PC with an existing player](https://www.dndencounters.net/img/tutorial/new_pc_existing.png)

You are required to attach this PC to an existing player, or create a new player to attach this PC to.  If you choose to create a new player from this screen,
then you must only enter the Player name.

![Adding a new PC with a new player](https://www.dndencounters.net/img/tutorial/pcs.png)

Other than that, the only required fields for a PC are the level, AC, Max HP, and PP (Passive Perception).  Everything else is optional.

![Adding a new PC with a new player](https://www.dndencounters.net/img/tutorial/pcs.png)

### Monsters Menu

The Monsters section is divided into two tabs: the Custom Monster tab and the SR Monster tab:

![List of all custom monsters](https://www.dndencounters.net/img/tutorial/custom_monsters.png)
![List of all SR monsters](https://www.dndencounters.net/img/tutorial/sr_monsters.png)

The Custom Monster tab is your place to add any monsters that you wish to participate in an encounter, but are not part of the
SR monsters.  This would include any monster from resource books, or modules that you may have purchased.  Manipulating
Custom Monsters is done the same way as Players or PC's.  Click on the Add Icon icon at the top
to add a new one, the Edit Icon icon next to the monster to wish to change to update that monster,
and Trash Icon icon will remove that monster from your account.  Once removed, all mentions of this
monster on encounters and modules will be removed as well.

![Adding a new custom monster.](https://www.dndencounters.net/img/tutorial/new_custom_monster.png)

Adding a new Custom Monster requires you to fill in most of the stats for that monster.  You only need to fill in the numerical
value of those stats (for example, int 10, not int +3), the system will then calculate the modifiers for you.  You can add
as many (or none) of the Special Abilities, Actions, and Legendary Abilities.  Any die rolls that include (including those for Hit Dice) will
be parsed automatically and will show up as a button, in order to allow you click the button to perform a random roll.

Alternatively, clicking on an SR monster will show you a display (un-editable) of that monster, including all actions and stats that the system
has available.

![Viewing an SR monster.](https://www.dndencounters.net/img/tutorial/sr_monster_template.png)

From this page, you can click the the button labeled "Make a Custom Monster Based on this Monster" to make a copy
of all the stats for the SR monster and copy them to the form to create a new custom monster.  This is especially
useful when the module monsters might be just an upgraded version of a regular, SR monster with different stats or die rolls.
You then don't have to re-enter all the information, simply edit the changes.

### Encounters Menu

This section will list all the encounters entered into the system.  Once information is entered it will look something like this:

![List of all encounters](https://www.dndencounters.net/img/tutorial/encounters.png)

Encounters are a collection of monsters (both SR and custom) that are grouped together.  Players will then fight the monsters from this
encounter.  This page is very similar in functionality to the Players and PC page. Click on the Add Icon at the top
to add a new encounter, the Edit Icon next to the encounter to wish to change to update that encounter,
and Trash Icon will remove that encounter from your account.  Once removed, all mentions of this
encounter on modules will be removed as well.

Adding a new encounter, however is slightly different than adding players or PC's.

![Adding a new encounter](https://www.dndencounters.net/img/tutorial/add_encounter.png)

The most important thing is to give a name to the encounter.  Make it descriptive, as you will most likely have a lot
of encounters, and searching for a specific one might be challenging if you give them generic names.  Once named, you add
monsters to the encounter by starting to type the monster's name in the search area.  As you type, the system will try to
auto-complete any monsters that it has in the database.  Once you see the monster that you like, click on it and it will be added
to the encounter.  Once the monster is added, you will have the option to remove the monster from the encounter (by clicking the
Trash Icon next to the monster you wish to remove), or to duplicate the monster.  You can duplicate
the monster by clicking on the Copy Icon icon.  This will add another of that type of monster to the
encounter. This is used in the case of encounters having the same monster, such as a goblin leader and 5 goblins.  Instead or re-typing
"Goblin" on the search bar 5 times, you can search once, add it, and duplicate it 4 times.

As you add monsters, the CR (Challenge Rating) of the encounter will increase based on the combined CR of all the monsters.  This
CR label does not do fractions, instead it will round the encounter down to the nearest CR.

### Monster Tokens Menu

This section will list all the monster tokens entered into the system.  Once information is entered it will look something like this:

![List of all monster tokens](https://www.dndencounters.net/img/tutorial/tokens.png)

As mentioned before, the purpose of monster tokens is so that, when you're playing on a board, with minis or some sort of
token designation, the DM can keep track of which token or mini represents the monster currently being dealt with.  For example,
you are currently running an encounter with 4 players and 5 monsters, 1 goblin leader and 4 goblins.  The players are in charge of their
own tokens or minis, so we can ignore them.  The goblins however, need to be represented by something. You, as the DM, have some simple
squares of paper with numbers on it.  So you can enter 5 number tokens which will only display a number on a white background and assign each
goblin to a numbered token.  This way, if a player is attacking Goblin #1, you can select the token labeled 1 and look at stats, or decrease their
hit points, or even kill them off.

There are four different kinds of tokens that you can add: Number Tokens, Color Tokens, Colored Number Tokens, and Minis.

![Adding a number token](https://www.dndencounters.net/img/tutorial/add_number_token.png)
![Adding a color token](https://www.dndencounters.net/img/tutorial/add_color_token.png)
![Adding a colored number token](https://www.dndencounters.net/img/tutorial/add_colored_number_token.png)
![Adding a mini for a token](https://www.dndencounters.net/img/tutorial/mini_token.png)

**Number Tokens**

A number token is simply a single number.  Each token will be displayed as a square with a white background and the number in the
middle.

**Color Tokens**

A color token is a token with a single color.  Each token will be displayed as a square with a background of the color you selected.  Clicking
on the "Color" field when adding or editing will bring up a color picker that will let you select the color of the token.

**Colored Number Tokens**

A colored number token is a token with with both a color and a number.  Each token will be displayed as a square with a background of the color you
selected, as well as the number you entered in the center.  Clicking on the "Color" field when adding or editing will bring up a color
picker that will let you select the color of the token.

**Mini Tokens**

A mini token is a token with a picture of the mini that you wish to use to represent the creature.  If you happen to have a large collection of minis,
you can take pictured of them and upload them as a token.  This picture will automatically be resized and cropped to be 64x64 pixels in order
to save on bandwidth and storage space.

### Modules Menu

This section will list all the modules entered into the system.  Once information is entered it will look something like this:

![List of all modules](https://www.dndencounters.net/img/tutorial/modules.png)

As previously mentioned, a module is a way to bundle a set of encounters that are usually played in the same adventure.  This is done to ease
the process of selecting encounters for an Adventuring Party, since a lot of the times, they run a module or adventure containing two or more encounters.
This feature allows you to select the module that the party is playing and all encounters will be added to the queue, without the need to add
each encounter individually.

![Adding a module](https://www.dndencounters.net/img/tutorial/add_module.png)

To add a module, four things are required.  The module name is used to select the module by name.  The more descriptive, the easiest it will be to find.
The modules description is optional, but it is also used to search.  The tier denotes for which tier of adventurer's it is appropiate, and the optimized
level is useful to calculate whether encounters will be easy or hard, based on the the party's APL.  Finally, you can select the encounters included in this
module by clicking on the encounter itself.  This will check and highlight the encounter and add it to the module.

## Running an Encounter

So you have entered everything you need to run an encounter (or more), you go to your game...now what?  Well, we start by heading to the
Dashboard and a new option is there, once everything is entered.

![Dashboard, once all required information is entered](https://www.dndencounters.net/img/tutorial/dashboard_ready.png)

An Adventure is simply a set of encounters parties run.  In a real adventure, there would be role playing and other components.  But this app
is only worried about the fighting.  So we will click on begin adventure and it will take us to the Adventure Setup screen.

### Adventure Setup

![Adventure setup](https://www.dndencounters.net/img/tutorial/adventure_setup.png)

There are 3 sections to the adventure setup.  The first section, on the left, is the Adventure Party.  This screen is used to set up the actual
party that will be running the adventure.  When you're first setting up the adventure, you will have the choice of assigning a new party to the
adventure, or to create a new one.  Since this is the first time creating an adventure, we can create a new one by click on the "Create New Party"
button.  The Party Creation Dialog will come up.

![Adventuring party setup](https://www.dndencounters.net/img/tutorial/adventure_party.png)
![Creating a New Party](https://www.dndencounters.net/img/tutorial/create_new_party.png)

You **must** assign a party name and select at least one member of the PC's to add to the party.  Once you create the party it
will be assigned to the adventure.  You can always click the Edit Icon icon to edit it.

![Party is created](https://www.dndencounters.net/img/tutorial/party_created.png)

One important detail of information is that it will calculate the APL (Average Party Level) for you, so that you can modify your encounters
appropriately.

The middle section in the adventure setup is the Quick Play Encounter.

![Quick play encounter](https://www.dndencounters.net/img/tutorial/current_encounter.png)

This feature allows you to quickly play an existing encounter instead of having to queue it.  Simply select the encounter from the list
and click on the Play Icon icon to start it.

For adventure which might require more than one quick encounter, you can set up multiple encounters in the third section, the Adventure Encounters
section.  This section allows you to queue encounters that this adventure might play.  There are two ways of doing this, either select a module
from the Current Module drop down, and all the encounters in that module will be added.  If you remove the module, the encounters will be removed.
You can also queue encounters individually by selecting them from the Encounter dropdown at the bottom, and clicking the Add button.  You can queue
up as many encounters as you wish this way and then play them in any order by clicking the Play Icon next
to the encounter you want to play.  For this example, we will be playing one of the queued encounters.

![A completed, ready to play adventure](https://www.dndencounters.net/img/tutorial/adventure_setup_done.png)

### Setting Up the Encounter

![Beginning of an encounter](https://www.dndencounters.net/img/tutorial/encounter_setup.png)

There are three sections to complete before starting the encounter.  The left-most section is where the player's initiative is listed.  You can
ask your players to roll and record them under each of their PC's name.  The middle section assigns tokens to monsters.  The system **will**
let you assign the same token to two or more monsters, although that is not recommended.  Simply select the token you wish to use from the dropdown and
small thumbnail picture of the token will appear.

The right-most and final sections are special options that you can set up for your encounter.  The **Assign Individual Monster Initiative**
option rolls initiative for each monster individually, instead of group initiative.  The **Roll for Each Monster's HP** option actually
assigns random hit points to each monster based on a hit die roll, instead of using the suggested, average value.  Once your encounter is set up, we are
ready to begin.  Continue by pushing the "Complete Setup" button at the bottom.

![An encounter completely set up and ready to start](https://www.dndencounters.net/img/tutorial/encounter_setup_complete.png)

### Running the Encounter
![The start of the encounter](https://www.dndencounters.net/img/tutorial/encounter_run1.png)

This is where you will be spending most of your time once you start the fight.  This page is divided into two sections.  The left section
is used to actually run the encounter, while the right section is used to see the encounter's current state and to change it on the fly if
you so desire.

#### Editing the Encounter

![Start of the encounter current state](https://www.dndencounters.net/img/tutorial/encounter_info.png)

Immediately, you can glean some very important information from this section.  You can see the flow of initiative since the players and monsters
are ordered by initiative, the highest one at the top.  You can see the player icon and monster tokens, to see which monster and player
goes when.  Highlighted green will be the current player up to turn, while anything highlighted gray will be players or monsters who
have already acted.  If any monsters die during the encounter, they will also be highlighted red.

**An important note about initiative ties**.  Sometimes players and monsters tie for initiative.  This is more
common when each monster rolls initiative individually.  The system will place them in order of Dexterity score, but sometimes
you may want to tweak the initiative ties position.  To do this, there is a special, **hidden** variable called position.
Everyone, monsters and players are set to position 1.  You can edit the monsters and players and change the position value
and it will put them down below other initiative.  For example, if you have a monster and player going on 15, the monster has higher Dex,
so they might go first.  But you, as the DM, decide to let the player go first.  You would then edit the monster (by clicking on the
monster name or the Edit Icon icon at the top, and changing the position for that monster to 2.  This
will make the player go first and the monster go second.

**UPDATE!** It is now possible to drag-organize the initiatives.  The position field will remain there as a backup, especially
since the reorder might be funky on the mobile platforms.

You can edit individual information from the edit icons at the top.  The Edit Icon icon will edit player information,
while the Edit Icon icon will edit monster information.  You can also click on each individual monster or player
to edit information for that monster/player only.

![Changing adventuring party information](https://www.dndencounters.net/img/tutorial/edit_party.png)
![Changing adventuring monsters information](https://www.dndencounters.net/img/tutorial/edit_encounter_monsters.png)

Please note that for players you can only change the AC, PP, SpellDC and initiative information (including the position), while for
monsters you can change whether they've acted, whether they're alive, as well as their current hit points, initiative
information and token.  You can also completely remove a monster from the encounter.  Adding a monster to the encounter is not yet supported.
Changing any of these values will re-calculate the initiative and update the turn.

Clicking on an individual player will let you update the same information for that player only.  Same as clicking on a monstet.  However,
clicking on an individual monster will not let you remove him from teh encounter.

#### Running the Encounter Turn

![Start of the round, player is up](https://www.dndencounters.net/img/tutorial/encounter_turn.png)

The Encounter Turn section is where the actual encounter will be run.  This section will show you the player or monster
whose turn is up.  In this case, for example, the first player, Joshua, is up next.  You can see some basic information about the player
that you would need.  The AC is there for attacks of opportunity, while Spell Dc is there in case the player cast a spell with a
saving throw.  Right below this information is the list of targets that the player can perform actions on.  Each target is denoted
by the tokens, since if you were playing on a board, the player might announce that it is attacking Token #1.  Click on the monster target
to see more information about the monster.

![Monster target basic information](https://www.dndencounters.net/img/tutorial/encounter_turn1_target.png)
![Monster target abilities](https://www.dndencounters.net/img/tutorial/encounter_turn1_monster_abilities.png)

There is a lot of information to display, so you might need to scroll.  At the top is the basig information about the monster, including the token,
monster type and size, and the AC to hit it.  Right below is the monster hit point panel, which is used to track hit points for the monster.  Below that are
all the attribute modifiers and any special properties of the monster, such as speed, alignment, resistances, etc.  Lastly, are all the special abilities,
actions, and legendary abilities that the monster might have.  From here we will be using the hit point control and the abilities section the most.

![Start of the round, player is up](https://www.dndencounters.net/img/tutorial/monster_hp_controls.png)
![Start of the round, player is up](https://www.dndencounters.net/img/tutorial/encounter_turn1_monster_abilities.png)
![Monster target abilities](https://www.dndencounters.net/img/tutorial/dire_roll.png)

The hit point control is useful for tracking monster health.  The number on the right is the number of hit points the monster has.  The buttons
labeled 1-10 are there to either cause that number of hit points in damage or heal those hit points, depending on what the top control is set to.  You can
never heal the monster above the max hit points, and you can never damage the monster below 0.  You can click the buttons multiple times to apply
any kind of hit operation.  For example, if the goblin is hit twice, once for 2 hit points and once for 1 hit point, click the 2 then the one and the total will
go down by 3.

The hit points are **not** updated, however, until you make a decision.  If you click on the "Finish with Monster" button, the monster target will
disappear, and the monster hit points will be updated.  The monster will not be marked dead however, even if it reaches 0 hit points.  This is to accommodate
for creatures like trolls who regenerate even if they're at 0.  If you wish to kill off the monster, click the "Mark Monster Dead" button.  This button
will lower the monster's hit points to 0, mark it dead, and remove it from the initiative turn.  You can always revive the monster by editing it.

The monster abilities have a special feature that might be useful.  The app will scan the text for each ability, parsing out any die rolls that
it might find, which are usually damage, and placing each die roll as a button below the ability.  If you press this button, the app will
execute the die roll and return an alert with the result.  This is useful if, instead of hitting players with the average damage, you want to actually
roll damage.  You can simply do it at the click of a button.

Once the target is dealt with, you can select another target or finish the turn by clicking the "Finish Turn" button, which will then come up with the next
player or monster up on initiative.

![Player turn ready to end](https://www.dndencounters.net/img/tutorial/encounter_turn1_end.png)
![Monster turn starting](https://www.dndencounters.net/img/tutorial/encounter_turn2.png)

Next up is the monster's turn.  You'll notice that the view is very similar to the monster target.  Only now we're concentrating on a single
monster, so only the information for that monster will appear.  Above the monster target view, however, will be a list of all the PC's in this
encounter with the information the monster might need to hit them or receive a hit.  There is nothing to click on the player's since the
visible information is the only information we have for them.

From here the turn runs similarly to the previous, only instead of having a "Finish Turn" button, the turn is ended by making a decision on
the monster.  The options are the same as before, "Finish with Monster" will save the hit points and end the monster's turn, while marking
the monster dead will set its hit points to 0, mark him dead, and remove him from initiative.

The encounter will continue with this flow.  The next monster or character will come up.  If it is a monster, you can either finish with them
or mark them dead.  If it is a player, you can select monsters to deal with and click on the finish turn button to complete the turn.  Once
all the monsters and character have gone, the end of the turn will be reached and the you can continue to the next turn.

![Everyone has gone, time for the next turn](https://www.dndencounters.net/img/tutorial/end_1st_turn.png)
![Starting the second turn.](https://www.dndencounters.net/img/tutorial/start_2nd_turn.png)

The second turn runs the same as the first.  Notice, however, that the players have killed two monster in the last turn (they are highlighted red).
These monsters will no longer come up on the initiative unless you mark them not-dead in the edit monsters section.

#### Completing the Encounter

At some point, the encounter will end.  This might be due to all of the monsters being dead or something else happening, such as the monsters
giving up.  You can end the encounter at anytime by clicking on the "Finish Encounter" button.  Doing so will close out the encounter and take you back
to the Adventure page, where you can run more encounters or complete the adventure.

![Encounter is over, what's next in the adventure?](https://www.dndencounters.net/img/tutorial/encounter_over_next.png)

From here, you can see the encounters this party has completed, you can finish the Adventure, which will close out all the information for this
adventure, or you can start a new encounter.  You do not have to immediately begin a new encounter.  You can always leave this page and, when you
get back to your dashboard, you can continue the adventure you were on, or start a new one.  Starting a new one will save the adventure that you're currently
on as an adventure currently being played, so you can always get back to it.  You can continue to play adventures as long as you don't finish them
by clicking the "Finish Adventure" button.

![Dashboard ready to continue last adventure](https://www.dndencounters.net/img/tutorial/dashboard_3.png)
![Dashboard ready to continue the last 2 adventures.](https://www.dndencounters.net/img/tutorial/dashboard_4.png)

### Concluding the Adventure

Once the adventure is concluded, it goes away.  You can no longer retrieve it or play it.  It is considered done and over.  You can then start another one
with the same party (with will be saved) or a new one with a different party.  The flow of each encounter will be the same.

## Tools

This app comes included with two tools to help your encounter.  Using these tools are completely optional and not part of the encounter.  The Dice Roller
tool allows you to roll a number of dice with a modifier, useful whenever you need to do a quick roll.  The spell lookup tools will give you
a searchable list of all the spells in the Player's Handbook and a full description of each spell. Both of these tools are accessible through the
user menu, which is the menu on the upper right hand corner with a drop down.

### Dice Roller

![Ready to roll some dice!](https://www.dndencounters.net/img/tutorial/die_roller.png)
![Die roll result](https://www.dndencounters.net/img/tutorial/die_roll_results.png)

The Dice Roller is accessed through the user menu in the upper right hand corner, by selecting the menu option "Dice Roller".  It will
bring up a dice dialog where you can pick from 1-10 dice or "Other" and specify the number of dice.  You must select the type of die from
the options of D4, D6, D8, D10, D12 and D20.  Finally, you can add a modifier that will be added or subtracted to the dice roll.  Click on the
"Roll!" button to execute the roll and get a result.

### Spell Lookup

![Search for any spells in the Player's Handbook](https://www.dndencounters.net/img/tutorial/spell_search.png)
![See all details about spells](https://www.dndencounters.net/img/tutorial/spell_view.png)

The Spell Search is accessed through the user menu in the upper right hand corner, by selecting the menu option "Spell Search". This will bring
up a search dialog.  Type in a spell or the partial name of a spell to get results.  Click on any of the results to see information about that spell.
Due to copyright restrictions, only the spells from the Player's Handbook are available.
