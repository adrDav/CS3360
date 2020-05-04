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
 mark :: Int -> Int -> [Coordinates] -> Player -> [Coordinates]
 mark x y bd p = map m bd 
  where m i = if xC i == x && yC i == y 
               then Coordinates {xC = x, yC = y, p = p} 
               else i 

 -- isEmpty x y bd

 -- isMarked x y bd
 --isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p

 -- marker x y board
 marker :: Int -> Int -> [Coordinates] -> Player
 marker x y board = p (head (filter f board))
   where f i = if xC i == x && yC i == y 
                then True
                else False


 -- isFull bd
 isFull bd = 0 == length (filter (\i -> p i == None)bd)

--3.
 -- isWonBy bd p
 -- isDraw bd
 -- isGameOver bd
 -- boardToStr playerToChar bd
 

