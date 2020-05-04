module Board where
--Extra Methods (Helper functions for assignment methods)
--printValues :: [[Int]] -> IO ()
--printValues = putStrLn. unlines . mkBoard
--1.

 data Player = Red | Blue | None deriving (Show, Eq)
 data Coordinates = Coordinates { x :: Int, y :: Int, p :: Player} deriving (Show)
 -- mkBoard n
 mkBoard :: Int -> [Coordinates]
 mkBoard n = [Coordinates { x = row, y = col, p = None} | row <- [1..(n-1)], col <- [1..(n-1)]]

 -- mkPlayer: Object of type 'Player', Player will be the color Red
 mkPlayer :: Player
 mkPlayer = Red

 -- mkOpponent: Object of type 'Player', Player will be the color Blue
 mkOpponent :: Player
 mkOpponent = Blue

 -- size bd
 size :: [Coordinates] -> Int 
 size bd =  length bd

 -- row y bd
 --row y bd 
  -- | y<1 || y>(size bd) = []
  -- | otherwise = bd !! (y-1)

 -- column x bd
 --column x bd = [a !! (x-1) | a<-bd]

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
 

