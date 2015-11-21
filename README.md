# EVGA-Scraper
Scraper for EVGA B-Stock Website written in PHP with Simple HTML DOM Parser
    _______    ___________       __               __             __  
   / ____/ |  / / ____/   |     / /_        _____/ /_____  _____/ /__
  / __/  | | / / / __/ /| |    / __ \______/ ___/ __/ __ \/ ___/ //_/
 / /___  | |/ / /_/ / ___ |   / /_/ /_____(__  ) /_/ /_/ / /__/ ,<   
/_____/  |___/\____/_/  |_|  /_.___/     /____/\__/\____/\___/_/|_|  
                                                          v0.0.3 
Arguements: ?argument=value&argumenttwo=valuetwo&...etc
	- load: Only accepts valid EVGA urls
		- Loads a GPU family
		- Used for navigation between categories
		- Appended to EVGA's site url
	- search: *
		- Preloads search field with value
		- Still loads rest of GPU listing
	- exact: *
		- Only displays gpus which contain the term stored in argument
		- Does not load other gpus
	- ui: bool, true or false
		- Whether or not to load navigation ui
		- Default true
	- plaintext: bool, true or false
		- Whether or not to load webpage in plain text to converse bandwidth
		- Default false
