module Board where
--1.
--Creation of types for both players and coordinates of the board.
 data Player = Red | Blue | None deriving (Show, Eq)
 data Coordinates = Coordinates { xC :: Int, yC :: Int, p :: Player} deriving (Show)
 -- mkBoard: Receives as input an integer n and returns an empty nxn board as the Coordinates type.
 mkBoard :: Int -> [Coordinates]
 mkBoard n = [Coordinates { xC = row, yC = col, p = None} | row <- [0..(n-1)], col <- [0..(n-1)]]

 -- mkPlayer: Object of type 'Player', Player will be the color Red.
 mkPlayer :: Player
 mkPlayer = Red

 -- mkOpponent: Object of type 'Player', Player will be the color Blue.
 mkOpponent :: Player
 mkOpponent = Blue

 -- size bd: Receives the board (array of coordinates) and returns the length of such object.
 size :: [Coordinates] -> Int 
 size bd =  length bd

 -- row y bd: Receives an integer y, where y represents a 1-based index. Returns the list of coordinates of the row.
 row :: Int -> [Coordinates] -> [Coordinates]
 row y bd = [i | i <- bd, yC i == y] 


 -- column x bd Receives an integer x, where x represents a 1-based index. Returns the list of coordinates of the column.
 column:: Int -> [Coordinates] -> [Coordinates]
 column x bd = [i | i <- bd, xC i == x] 

 --2.
 -- mark x y bd p

 -- isEmpty x y bd
 --isEmpty x y bd = ((row y bd) !! (x-1) == 0)

 -- isMarked x y bd
 --isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p

 -- marker x y board

 -- isFull bd
 --isFull bd = length (filter (\x->x==0)(concat bd)) == 0

--3.
 -- isWonBy bd p
 -- isDraw bd
 -- isGameOver bd
 -- boardToStr playerToChar bd
 

