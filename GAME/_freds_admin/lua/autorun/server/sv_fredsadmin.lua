require( "mysqloo" )
local queue = {} // NO TOUCHY



//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
////////////////////////ONLY TOUCH THE CONFIG/////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////

local db = mysqloo.connect( "HOSTNAME", "DATABASE_USER", "DATABASE PASSWORD", "DATABASE_NAME", 3306 ) // I do provide database support as well as hosting if you desperately need one :)
local checkTime = 10 // How often (in seconds) should we check to see if we need to run a command from the website (Default: 10) I suggest lowering this if you have OCD when it comes to lag.

// ^ Only touch those plz <3


//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
///////////NO MORE TOUCH//////////////
//////////////////////////////////////
//////////////////////////////////////

db:connect()
function db:onConnected()

	for k, v in pairs( queue ) do

		query( v[ 1 ], v[ 2 ] )

	end
	timer.Create( "checkTimer", checkTime, 0, function() query("SELECT * FROM `commands`", callback) end  )
	timer.Create( "playerTimer", 5, 0, function() 
	query("TRUNCATE `players`", callback)
	for k, v in pairs( player.GetAll() ) do
		local addID = v:SteamID()
		local addName = v:Nick()
		local addUsergroup = v:GetUserGroup()
		local toQuery = "INSERT INTO `players`(`name`, `steamid`, `usergroup`) VALUES ('" .. addName .. "','" .. addID .. "','" .. addUsergroup .. "')"
		
		query(toQuery, callback)
	end


	end )
	queue = {}
	PrintMessage( HUD_PRINTCENTER, "Fred's Admin System: Success! We have connected to the database!" )

end

function CheckCommands()
	
	
	

end

function query( sql, callback )

	local q = db:query( sql )
	function q:onSuccess( data )
		if table.ToString(data, "checker", false) != "checker={}" then
			local finalStr = table.ToString( data, "Stuff", true)
			local startPos = string.find(finalStr, "+", 1, false)
			local endPos = string.find(finalStr, "-", 1, false)
			local commandPrep = string.sub( finalStr, startPos + 1, endPos - 1)
			game.ConsoleCommand(commandPrep .. "\n")
			dquery("DELETE FROM `commands` WHERE `command` = '+" .. commandPrep .. "-'", callback)
		end
		
	end

	function q:onError( err )

		if db:status() == mysqloo.DATABASE_NOT_CONNECTED then

			table.insert( queue, { sql, callback } )
			db:connect()
			return
		end

		print( "Query Errored, error:", err, " sql: ", sql )

	end

	q:start()

end
 
function dquery( sql, callback )

	local q = db:query( sql )
	function q:onSuccess( data )
		
	end

	function q:onError( err )

		if db:status() == mysqloo.DATABASE_NOT_CONNECTED then

			table.insert( queue, { sql, callback } )
			db:connect()
			return
		end

		print( "Query Errored, error:", err, " sql: ", sql )

	end

	q:start()

end 


 
function db:onConnectionFailed( err )
 
    print( "Connection to database failed!" )
    print( "Error:", err )
	PrintMessage( HUD_PRINTCENTER, "Fred's Admin System: Connection to the Database has Failed!" )
	PrintMessage( HUD_PRINTCENTER, "ERROR RIP: " .. err )
 
end
 
