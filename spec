In this game players roll dice and try to collect the lowest score. A 4 counts as zero, all other numbers count as face value. A player’s score is the total spots showing on the dice when she finishes her turn (excluding fours because they’re zero). The object of the game is to get the lowest score possible.

The game is played as follows between 4 players:

    Play starts with one person randomly being chosen to start rolling and proceeds in succession until all players have rolled.

    The player rolls all five dice, then must keep at least one dice but may keep more at her discretion (She can stop on her first roll if she so wishes).

    Those dice which are not kept are rolled again and each round she must keep at least one more until all the dice are out.

    Once each player has rolled the player who scored the lowest wins.

    Repeat for three more rounds in succession so that the next person starts rolling first (at the end each player will have started).


questions
 - interactive, random AI or smart AI?
   - interactive implies that a player's move needs to be validated
   - random is simpler
   - smart means somethign something
 - D6?
   - D6 is the one that has spots, so that's probably the intent of the spec
 - 


classes
 - Dice
   - roll()
 - player
   - analyzeRoll( rolls, turn ) - look at a roll, decide which die to keep and which to reject
 - playerStrategy
   - storeMove( rolls, dieTaken, turn, player) - store data about what moves another player has made
   - 
 - game
   - players
     - ordered array, gets barrel rotated throughout the game so that every player starts once
   - config
   - scores
   - rollDice()
   - handleRoll() - tell the game what a player has decided to do with a roll (keep 1, keep all, etc)
   - showScores()
   - playGame() - main loop
   - addPlayer(player)
   - 

 - 
