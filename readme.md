# DnDEncounters
## What is this app for?
This is a tool to help DMs run encounters.  This tool was build for Dungeons & Dragons 5th edition, using monsters and spells from that edition.

## What this is **not** for
This is not an app to manage all aspects of encounters.  Nor is it an information-heavy app that allows you track all encounter variables.  Rather this was built with the idea that it should be as lightwaight as possible, aiding the DM in the encounter by entering the least possible amount of data.  This app is sued to track the following information on each enounter:
* Encounter Initiative
* Monster Tokens
* Monster HPs
* Turn flow

It also has some simple tools to aid in looking up information, such as a simple spell lookup.  All of these tools are made with the idea that the DM already has a lot to track, so it should avoid tracking unnessesary data for it's own sake.
## App Concepts
This app is build around the concept of an **Encounter**.  An **Enconter** is defined as a single fight between a **Party** of PCs (Player Characters) and a number of **Monsters**. Each PC is a **Character** that is being played by a **Player**, while each **Monster** is a valid D&D 5e Monsters that is represented by a real-life **Monster Token**.  Usually, player and monsters tokens are played in a mat with squares to account for movement, tactics, etc.  At the start of each **Encounter**, **Players** roll initiative for their **Characters**, while the DM may either roll a single inititative for all **Monster** or individual inititatives for each **Monster**.  The App will then run as many **Encounter Turns** as it takes to either kill all the **Monsters** or for the DM to call off the encounter.

Each **Encounter Turn** is made up of **Rounds**, in which each **Character** or **Monster** performs actions.  The App will track number of turns, and the **HP** of the monsters.  It **will not**, however, track any of the PC's healthor stats, relying on the players themselves to do this.

You can setup **Adventures**, which is a **Party** with encounters assigned to them.  The app will track all encounters not completed and completed, as well as the current encounter being run.  You can have as many active **Adventures** as you wish.  Once an **Adventure** is finished, information will be saved about it for later inspection.

## Getting Started

Thee are three sections that should be filled out before any encounters can happen: **Players**, **Encounters**, and **Monster Tokens**.  To fill these our, open the App Drawer from the main page and select them.

### Players
This is a list of all the players in your APP.  From here you can add, view, edit, or delete all players in your system.  Each player is represented by a name, a DCI number (optional) and a thumbnail portrait that you can take using your camera (again, optional).  Each player also has characters attached to them.  These can be seen once you click on a player and view information about them.  You can add, edit an delete characters from the View Player screen.

#### Character
Each player can have as many PCs as they wish.  Each PC will have the bare minimum information that the DM might need to run an encounter.  Not all of the information is required, and you do not need to update it if you don't wish to.  This information is used in places where it would be useful for the DM to know the AC of a character, or the total HP in case the incoming damage is high and the DM doesn't want to kill a PC.  The following information can be entered for each PC:
* Name (Required)
* Class
* Race
* AC (Required)
* HP
* PP
* Level
* Spell DC

### Encounters
An encounter is a a group of **Monsters**.  You can create as many encounters as you wish, the App will calculate CR for your.  The idea is to have all **Encounters** you might run during an adventure already prepared so you can just pull them into your adventure and play them.  The **Encounters** are reusable, meaning you can play an Encounter with different parties, or even in the same adventure.

All **Monsters** from the SDR of D&D 5e are included in this App.  At this point there is no way to add your own, custom moster, but that capcbility will be forthcoming.

### Monster Tokens
This is the real-life representation of your **Monsters** in the **Encounter**.  This App is best used when playing a battle mat with minis or token representing players and monsters.  As such, you can define all the tokens that you may use for monsters in this section. The App will **not** keep track of Player tokens, as they can do this themselves.

There are 4 different types of tokens you can define:
* Number Token: This is a simple token containing a number.  They may be a piece of paper with a number on the table, or perhaps a plastic chit with a number written on it.
* Colored Token: A simple token of a specific color, with no other markings.
* Colored Number Token: A combination of the last two, which is a token with both a number and a color.
* Mini: A miniature.  You can take a picture of it to represent it.

## Setting up an Adventure
Once you have the last section filled out, it's time to start the adventure.  This step would usually be done when first sitting down with the Players.  In my games, I generally go around and ask details of each of the PC's at the table.  In the app, you would start a new adventure, which would take you to the Create Party section.  In here you create the party of adventurers at your table.  You should give them a name (in case you run a lot of different tables) and from here you can either select existing PC's, create and add a new **Character** to an existing **Player**, or create a new **Player** and **Character** directly.  Once you're happy with your party (you can always change it later), you can go on to the adventure setup.

In the adventure setup is where you can define what encounters your party will go through.  From here you can change your party as well, even between encounters.  You can select a number of encounters for the party to run, or even a single encounter for a one-off.  You can, for example, plan ahead for your adventure to run 3 encounters, but have  asurprise 4th that you pull up in the moment.  All adventure and parties will be saved, so even if you don't finish all the encounters, you can come back to them, so long as **you don't finish the adventure**.

## Playing Encounters
Once your adventure is set up, you're ready to run the encounter.  There is a last bit of set up to do for each encounter.  Mainly you must assign **Monster Tokens** and assign **Player Initiative**.  To do this, press the corresponding button.  Each monster in the encounter must be assigned to a token.  If you're using Theater of the Mind, or don't care about token, you can assign them all the same.  However, the App erally shines when each monster has their own token.

You must also assign initiative for each player.  This is done by entering the Inititaitve value next to the PC's name.

Finally, you can choose for each monster to have it's own initiative (individual initiative) and whether to roll for the Monster's HP, or to use the default from the Monster's manual.

Once set up, you will shown the initiative table.  You can start each turn from here, and once you do, each Monster or PC will come up for you to "deal" with.  If it is a Player round, then you be shown a list of available monsters (meaning, not dead) that you can target.  Once you select each monster, information about it will come up, allowing the DM to quickly use as reference to deal with the player action.  From here you can also alter the Monster's HP. The system will **not** mark a monster dead automatically when the HP reaches 0, as some monsters (such as Trolls) are not really dead unless something is done about their regeneration.  You mut manually mark a monster dead to remove him from the list of active targets and inititative.

The rounds will continue until the turn is over, at which point you will be given the option to end the turn and go to the next one, or finish the encounter.  That's the end of the app.  From here you can run another encounter, or go back and select anohter adventure, or anything else.

## Aditional Tools
The app does provide at least one additional tool (more to come later) to make life easier on the DM.  The design philosophy of each tool is to alleviate data enetered by the DM and to make each tool as simple as possible.

### Spell Lookup
From the menu item on the app you can select **Spell Lookup**.  This is a searchable database of all D&D 5e spells.  Click on the spell to see more information. Click the back button to go back to what you were doing.

## Marketplace Information
At the time of this writing the App is **not** yet available in the Markeplace, as it is still going through debugging.  If you wish to try it out, you must compile it from source. It will be uploaded to the Marketplace once it is sufficently debugged, so look for it soon!
